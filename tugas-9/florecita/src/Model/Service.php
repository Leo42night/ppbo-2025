<?php
declare(strict_types=1);
namespace LaundryApp\Model;

use LaundryApp\Traits\LoggerTrait;
use JsonSerializable;
use IteratorAggregate;
use ArrayIterator;
use Serializable;
use ReflectionClass;
use Exception;

class Service implements JsonSerializable, IteratorAggregate, Serializable
{
    use LoggerTrait;

    public const STATUS_PENDING = 'pending';
    public const STATUS_DONE = 'done';

    private int $id;
    protected string $customer;
    protected string $service;
    protected float $price;
    private string $status;

    // magic constructor
    public function __construct(int $id, string $customer, string $service, float $price, string $status = self::STATUS_PENDING)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->service = $service;
        $this->price = $price;
        $this->status = $status;
        $this->log("Service::__construct id={$id}");
    }

    public function __toString(): string
    {
        return sprintf("Service#%d(%s:%s,%.2f,%s)", $this->id, $this->customer, $this->service, $this->price, $this->status);
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new Exception("Property {$name} not found");
    }

    public function __set($name, $value)
    {
        if ($name === 'price') {
            $this->price = (float)$value;
            return;
        }
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return;
        }
        throw new Exception("Property {$name} cannot be set");
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer,
            'service' => $this->service,
            'price' => $this->price,
            'status' => $this->status
        ];
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->jsonSerialize());
    }

    // cloning hook
    public function __clone()
    {
        $this->id = 0; // reset id for cloned object, will be re-assigned by repository
        $this->log("Service::__clone created clone with id reset");
    }

    public function serialize(): string
    {
        return serialize($this->jsonSerialize());
    }

    public function unserialize($data): void
    {
        $arr = unserialize($data);
        $this->id = $arr['id'] ?? 0;
        $this->customer = $arr['customer'] ?? '';
        $this->service = $arr['service'] ?? '';
        $this->price = (float)($arr['price'] ?? 0.0);
        $this->status = $arr['status'] ?? self::STATUS_PENDING;
    }

    // reflection demo
    public static function describe(): array
    {
        $r = new ReflectionClass(self::class);
        return [
            'name' => $r->getName(),
            'isFinal' => $r->isFinal(),
            'methods' => array_map(fn($m)=>$m->getName(), $r->getMethods())
        ];
    }
}
