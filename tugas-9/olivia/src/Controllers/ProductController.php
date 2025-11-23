<?php
namespace App\Controllers;

use App\Core\Database;
use App\Exceptions\DataNotFoundException;
use App\Interfaces\Storable;
use App\Models\AbstractProduct;
use App\Models\Book;
use App\Models\Electronics;

// 14. Penerapan CRUD dengan OOP & 15. Penerapan MVC
class ProductController implements Storable
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function save(AbstractProduct $product): bool
    {
        $details = '';
        if ($product instanceof Book) {
            $details = json_encode(['author' => $product->getAuthor()]);
        } elseif ($product instanceof Electronics) {
            $details = json_encode(['brand' => $product->getBrand()]);
        }

        $stmt = $this->db->prepare(
            "INSERT INTO products (type, name, price, details) VALUES (:type, :name, :price, :details)"
        );

        return $stmt->execute([
            ':type' => $product->getProductType(),
            ':name' => $product->getName(),
            ':price' => $product->getPrice(),
            ':details' => $details,
        ]);
    }
    
    // 10. Exception Handling (try-catch-finally)
    public function findById(int $id): ?AbstractProduct
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                throw new DataNotFoundException("Produk dengan ID {$id} tidak ditemukan.");
            }

            $details = json_decode($data['details'], true);

            $product = null;
            if ($data['type'] === 'Buku') {
                $product = new Book($data['name'], $data['price'], $details['author']);
            } elseif ($data['type'] === 'Elektronik') {
                $product = new Electronics($data['name'], $data['price'], $details['brand']);
            }

            if ($product) {
                $product->setId($data['id']);
            }
            return $product;

        } catch (DataNotFoundException $e) {
            error_log($e->getDetailedMessage());
            return null;
        } finally {
            // Blok ini akan selalu dieksekusi
            // echo "Proses pencarian produk selesai.<br>";
        }
    }
    
    public function showProduct(int $id)
    {
        $product = $this->findById($id);
        // Ini adalah bagian "View" dari MVC
        require_once __DIR__ . '/../../views/product_view.php';
    }
}