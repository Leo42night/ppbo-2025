<?php
declare(strict_types=1);
namespace LaundryApp\Controller;

use LaundryApp\Model\ServiceRepository;
use LaundryApp\Model\Service;
use LaundryApp\Interfaces\RepositoryInterface;
use Exception;

final class ServiceController
{
    private RepositoryInterface $repo;

    public function __construct()
    {
        // Dependency Injection: inject repository (composition)
        $this->repo = new ServiceRepository(\DATA_FILE);
    }

    public function index(): string
    {
        ob_start();
        $services = $this->repo->all();
        include __DIR__ . '/../../views/index.php';
        return ob_get_clean();
    }

    public function api(): string
    {
        $method = $_SERVER['REQUEST_METHOD'];
        try {
            if ($method === 'GET') {
                $data = array_map(fn($s)=>$s->jsonSerialize(), $this->repo->all());
                return json_encode(['status'=>'ok','data'=>$data]);
            }
            if ($method === 'POST') {
                $in = json_decode(file_get_contents('php://input'), true) ?: $_POST;
                $action = $in['action'] ?? '';
                if ($action === 'create') {
                    $s = new Service(0, (string)($in['customer'] ?? ''), (string)($in['service'] ?? ''), (float)($in['price'] ?? 0));
                    $saved = $this->repo->save($s);
                    return json_encode(['status'=>'ok','data'=>$saved->jsonSerialize()]);
                }
                if ($action === 'update') {
                    $s = new Service((int)$in['id'], (string)($in['customer'] ?? ''), (string)($in['service'] ?? ''), (float)($in['price'] ?? 0), (string)($in['status'] ?? Service::STATUS_PENDING));
                    $saved = $this->repo->save($s);
                    return json_encode(['status'=>'ok','data'=>$saved->jsonSerialize()]);
                }
                if ($action === 'delete') {
                    $ok = $this->repo->delete((int)$in['id']);
                    return json_encode(['status'=>'ok','deleted'=>$ok]);
                }
                if ($action === 'describe') {
                    return json_encode(['status'=>'ok','desc'=>Service::describe()]);
                }
            }
            throw new Exception("Unsupported method");
        } catch (Exception $e) {
            return json_encode(['status'=>'error','message'=>$e->getMessage()]);
        } finally {
            // finally block
        }
    }
}
