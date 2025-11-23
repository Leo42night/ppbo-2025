<?php
namespace App\Models\Traits;

trait Timestampable
{
    protected \DateTimeImmutable $createdAt;
    protected \DateTimeImmutable $updatedAt;

    public function touch(): void
    {
        $this->updatedAt = new \DateTimeImmutable('now');
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
