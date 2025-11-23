<?php
namespace Traits;
// Konsep: Trait
trait HasTimestamp {
    private \DateTime $createdAt;
    public function initializeTimestamp() {
        $this->createdAt = new \DateTime();
    }
    public function getCreationDate(): string {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}