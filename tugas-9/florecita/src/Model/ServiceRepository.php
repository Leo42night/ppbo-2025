<?php
declare(strict_types=1);
namespace LaundryApp\Model;

use LaundryApp\Interfaces\RepositoryInterface;
use Exception;

class ServiceRepository implements RepositoryInterface
{
    private string $file;

    // static property and method
    private static int $lastId = 0;

    public function __construct(string $file)
    {
        $this->file = $file;
        $this->initLastId();
    }

    private function initLastId(): void
    {
        $data = json_decode(file_get_contents($this->file), true) ?: [];
        $ids = array_map(fn($it)=>$it['id'] ?? 0, $data);
        self::$lastId = $ids ? max($ids) : 0;
    }

    public function all(): array
    {
        $arr = json_decode(file_get_contents($this->file), true) ?: [];
        return array_map(fn($d)=>$this->mapToService($d), $arr);
    }

    public function find(int $id): ?Service
    {
        foreach ($this->all() as $s) {
            if ($s->id === $id) return $s;
        }
        return null;
    }

    public function save(Service $service): Service
    {
        $all = json_decode(file_get_contents($this->file), true) ?: [];
        // new?
        if ($service->id === 0) {
            self::$lastId++;
            // clone to avoid modifying original passed object id unexpectedly
            $s = clone $service;
            $s->__set('id', self::$lastId); // using __set to set id indirectly will throw; instead reflect
            // set id via temp array
            $tmp = $s->jsonSerialize();
            $tmp['id'] = self::$lastId;
            $all[] = $tmp;
            file_put_contents($this->file, json_encode($all, JSON_PRETTY_PRINT));
            return $this->mapToService($tmp);
        } else {
            $found = false;
            foreach ($all as &$item) {
                if (($item['id'] ?? 0) === $service->id) {
                    $item = $service->jsonSerialize();
                    $found = true;
                    break;
                }
            }
            if (!$found) throw new Exception("Service not found");
            file_put_contents($this->file, json_encode($all, JSON_PRETTY_PRINT));
            return $service;
        }
    }

    public function delete(int $id): bool
    {
        $all = json_decode(file_get_contents($this->file), true) ?: [];
        $orig = count($all);
        $all = array_filter($all, fn($it)=>($it['id'] ?? 0) !== $id);
        file_put_contents($this->file, json_encode(array_values($all), JSON_PRETTY_PRINT));
        return count($all) < $orig;
    }

    private function mapToService(array $d): Service
    {
        $s = new Service($d['id'] ?? 0, $d['customer'] ?? '', $d['service'] ?? '', (float)($d['price'] ?? 0), $d['status'] ?? Service::STATUS_PENDING);
        return $s;
    }
}
