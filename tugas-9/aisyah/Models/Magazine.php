<?php
namespace PerpustakaanApp\Models;

final class Magazine extends LibraryItem {
    private string $issueNumber;
    private string $publisher;
    
    public function __construct(string $id, string $title, float $price, string $issueNumber, string $publisher) {
        parent::__construct($id, $title, $price);
        $this->issueNumber = $issueNumber;
        $this->publisher = $publisher;
    }
    
    public function getDetails(): string {
        return "Magazine: {$this->title} - Issue {$this->issueNumber} by {$this->publisher}";
    }
    
    public function getIssueNumber(): string {
        return $this->issueNumber;
    }
}