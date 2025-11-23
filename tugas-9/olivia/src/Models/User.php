<?php

namespace App\Models;

// 20. Cloning Object
class User
{
    private string $username;
    private string $email;
    private array $data = []; // Untuk demo __get dan __set

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->username;
    }
    
    // 3. Magic Methods: __get, __set, __toString
    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    public function __toString(): string
    {
        return "User(username='{$this->username}', email='{$this->email}')";
    }

    // 3. Magic Method: __destruct
    public function __destruct()
    {
       // echo "Objek User {$this->username} dihancurkan.<br>";
    }
    
    // 20. Magic Method: __clone
    public function __clone()
    {
        $this->username = $this->username . '_copy';
    }
}