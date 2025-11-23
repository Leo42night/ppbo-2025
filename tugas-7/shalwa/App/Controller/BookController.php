<?php

namespace App\Controller;

use App\Core\View;
use App\Repository\RepositoryInterface;
use App\Model\Book;
use App\Model\BookCollection;
use App\Trait\Loggable;

// by Leo: inisiasi awal (fix error $getters)
Book::init();

final class BookController extends BaseController // Final class (7) + Inheritance (4)
{
    use Loggable; // Trait (10)

    public function index(): string
    {
        /** @var RepositoryInterface $repo */
        $repo = $this->container->get(RepositoryInterface::class);
        $books = new BookCollection($repo->all()); // Object iteration (16)
        $rows = '';
        $BASE_URL = BASE_URL;
        foreach ($books as $b) { // foreach pada IteratorAggregate (16)
            $rows .= "<tr><td>{$b->id}</td><td>{$b->title}</td><td>{$b->author}</td>
            <td>
              <a href=\"" . $BASE_URL . "/books/show?id={$b->id}\">Detail</a>
            </td></tr>";
        }

        $form = <<<HTML
                <form method="POST" action="{$BASE_URL}/books/create">
                <h3>Tambah Buku</h3>
                <input name="title" placeholder="Judul" required>
                <input name="author" placeholder="Penulis" required>
                <button type="submit">Simpan</button>
                </form>
            HTML;

        $table = "<table><thead><tr><th>ID</th><th>Judul</th><th>Penulis</th><th>Aksi</th></tr></thead><tbody>{$rows}</tbody></table>";
        return $this->container->get(View::class)->render('Daftar Buku', $form . $table);
    }

    public function store(array $data): string
    {
        /** @var RepositoryInterface $repo */
        $repo = $this->container->get(RepositoryInterface::class);
        $book = new Book($data['title'] ?? 'Tanpa Judul', $data['author'] ?? 'Anonim'); // __construct (3)
        $repo->create($book); // CRUD (14)
        self::log("Create: {$book}"); // __toString (3) + Trait static log (12,10)
        return $this->index();
        // return json_encode($data);
    }

    public function update(array $data): string
    {
        /** @var RepositoryInterface $repo */
        $repo = $this->container->get(RepositoryInterface::class);
        $id = (int)($data['id'] ?? 0);
        $book = $repo->find($id);
        if ($book) {
            // Encapsulation via __set (2,3)
            $book->title = (string)($data['title'] ?? $book->title);
            $book->author = (string)($data['author'] ?? $book->author);
            $repo->update($book);
            self::log("Update: {$book}");
        }
        return $this->index();
    }

    public final function delete(int $id): string // final function (7)
    {
        /** @var RepositoryInterface $repo */
        $repo = $this->container->get(RepositoryInterface::class);
        $repo->delete($id);
        self::log("Delete: id={$id}");
        return $this->index();
    }

    public function show(int $id): string
    {
        /** @var RepositoryInterface $repo */
        $repo = $this->container->get(RepositoryInterface::class);
        try { // Exception handling (9)
            $book = $repo->find($id);
            if (!$book) {
                throw new \RuntimeException("Buku id {$id} tidak ditemukan");
            }

            // Reflection (17)
            $ref = new \ReflectionClass($book);
            $props = array_map(fn($p) => $p->getName(), $ref->getProperties());
            // var_dump($props);
            // Cloning (19): clone lalu modifikasi sementara
            $clone = clone $book; // __clone (19)
            $clone->title = $book->title . " (clone)";

            // Serialization (15)
            $serialized = serialize($book);
            $restored = unserialize($serialized);
            $BASE_URL = BASE_URL;
            $content = <<<HTML
                <p><strong>ID:</strong> {$book->id}</p>
                <p><strong>Judul:</strong> {$book->title}</p>
                <p><strong>Penulis:</strong> {$book->author}</p>
                <form method="POST" action="{$BASE_URL}/books/update">
                    <input type="hidden" name="id" value="{$book->id}">
                    <input name="title" value="{$book->title}">
                    <input name="author" value="{$book->author}">
                    <button>Update</button>
                </form>
                <form method="POST" action="{$BASE_URL}/books/delete" onsubmit="return confirm('Hapus?')">
                    <input type="hidden" name="id" value="{$book->id}">
                    <button>Delete</button>
                </form>
                <hr>
                HTML;

                $content .= sprintf(
                    '<p><strong>Reflection props:</strong> <code>%s</code> → <code>%s</code></p>',
                    htmlspecialchars($ref->getName(), ENT_QUOTES, 'UTF-8'),
                    htmlspecialchars(implode(', ', $props), ENT_QUOTES, 'UTF-8')
                );

                $content .= <<<HTML
                <p><strong>Clone preview:</strong> {$clone->title}</p>
                <p><strong>Serialized length:</strong> 
                HTML;

                $content .= strlen($serialized);

                $content .= <<<HTML
                </p>
                HTML;


            return $this->container->get(View::class)->render("Detail Buku #{$id}", $content);
        } catch (\Throwable $e) {
            return $this->container->get(View::class)->render('Error', "<p>{$e->getMessage()}</p>");
        } finally {
            self::log("Show called for id={$id}");
        }
    }
}
