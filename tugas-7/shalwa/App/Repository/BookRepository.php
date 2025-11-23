<?php
namespace App\Repository;

use App\Model\Book;
use App\Trait\Loggable;

class BookRepository implements RepositoryInterface
{
    use Loggable;

    public static int $nextId = 1; // Static property (12)

    /** @return array<int, Book> */
    public function all(): array
    {
        return $_SESSION['books'] ?? [];
    }

    public function create(Book $book): Book
    {
        $book->setId(self::$nextId++);
        $list = $this->all();
        $list[$book->getId()] = $book;
        $_SESSION['books'] = $list;

        // Persist ringkas dengan serialization (15)
        $_SESSION['books_serialized'] = serialize($list);
        return $book;
    }

    public function find(int $id): ?Book
    {
        $list = $this->all();
        if (isset($list[$id])) return $list[$id];

        // Coba restore dari serialized (15)
        if (!empty($_SESSION['books_serialized'])) {
            $restored = unserialize($_SESSION['books_serialized']);
            if (is_array($restored) && isset($restored[$id])) {
                $_SESSION['books'] = $restored;
                return $restored[$id];
            }
        }
        return null;
    }

    public function update(Book $book): Book
    {
        $list = $this->all();
        $list[$book->getId()] = $book;
        $_SESSION['books'] = $list;
        $_SESSION['books_serialized'] = serialize($list);
        return $book;
    }

    public function delete(int $id): void
    {
        $list = $this->all();
        unset($list[$id]);
        $_SESSION['books'] = $list;
        $_SESSION['books_serialized'] = serialize($list);
    }
}
