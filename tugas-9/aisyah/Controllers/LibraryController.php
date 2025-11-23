<?php
namespace PerpustakaanApp\Controllers;

use PerpustakaanApp\Models\{Book, Magazine, Library, BookCounter, DynamicLibrary};
use PerpustakaanApp\Services\{LibraryService, Inspector};
use PerpustakaanApp\Views\LibraryView;

class LibraryController {
    private Library $library;
    private LibraryService $service;
    private LibraryView $view;
    
    public function __construct() {
        $this->library = new Library();
        $this->service = new LibraryService($this->library);
        $this->view = new LibraryView();
    }
    
    public function run(): void {
        $this->view->renderHeader();
        $this->initializeData();
        $this->demonstrateAllFeatures();
        $this->view->renderFooter();
    }
    
    private function initializeData(): void {
        $book1 = new Book("B001", "PHP OOP Complete Guide", 150000, "John Doe", "978-1234567890");
        $book2 = new Book("B002", "Advanced PHP Programming", 200000, "Jane Smith", "978-0987654321");
        $magazine1 = new Magazine("M001", "Tech Monthly", 50000, "Issue 42", "Tech Publishers");
        
        $this->library->addItem($book1);
        $this->library->addItem($book2);
        $this->library->addItem($magazine1);
    }
    
    private function demonstrateAllFeatures(): void {
        $book1 = $this->library->getItem("B001");
        
        // Scope & Encapsulation
        $content = '<div class="info-box">
            <div class="info-label">Book Title:</div>
            <div class="info-value">' . htmlspecialchars($book1->getTitle()) . '</div>
        </div>';
        $this->view->renderSection('Scope & Encapsulation', $content);
        
        // Magic Methods - __toString()
        $content = '<div class="info-value">' . htmlspecialchars($book1) . '</div>';
        $this->view->renderSection('Magic Method: __toString()', $content);
        
        // Inheritance & Polymorphism
        $content = '<div class="info-value">' . htmlspecialchars($book1->getDetails()) . '</div>';
        $this->view->renderSection('Inheritance & Polymorphism', $content);
        
        // Exception Handling
        $libraryService = new LibraryService($this->library);
        $result1 = $libraryService->borrowItem("B001", "Ahmad");
        $result2 = $libraryService->borrowItem("B001", "Budi");
        
        $content = '<div class="info-box">
            <div class="info-label">Borrow Attempt 1:</div>
            <div class="info-value" style="color: #28a745;">' . htmlspecialchars($result1) . '</div>
        </div>
        <div class="info-box">
            <div class="info-label">Borrow Attempt 2:</div>
            <div class="info-value" style="color: #dc3545;">' . htmlspecialchars($result2) . '</div>
        </div>';
        $this->view->renderSection('Exception Handling & Dependency Injection', $content);
        
        // Trait - Logging
        $logs = $book1->getLogs();
        $logOutput = '';
        foreach (array_slice($logs, 0, 5) as $log) {
            $logOutput .= '<div class="log-item">' . htmlspecialchars($log) . '</div>';
        }
        $this->view->renderSection('Trait: Logging', $logOutput);
        
        // Object Iteration
        $itemsOutput = '';
        foreach ($this->library as $id => $item) {
            $status = $item->isAvailable() ? 'Available' : 'Borrowed';
            $itemsOutput .= '<div class="item">' . htmlspecialchars($id) . ': ' . 
                htmlspecialchars($item->getTitle()) . ' (' . $status . ')</div>';
        }
        $this->view->renderSection('Object Iteration', $itemsOutput);
        
        // Reflection
        $bookInfo = Inspector::inspectClass(Book::class);
        $content = '<div class="info-box">
            <div class="info-label">Class Name:</div>
            <div class="info-value">' . htmlspecialchars($bookInfo['name']) . '</div>
        </div>
        <div class="info-box">
            <div class="info-label">Total Methods:</div>
            <div class="info-value">' . count($bookInfo['methods']) . '</div>
        </div>';
        $this->view->renderSection('Reflection API', $content);
        
        // Summary
        $content = '<p style="color: #28a745; font-weight: bold;">
            Semua 20 materi OOP PHP telah berhasil diimplementasikan dengan MVC Architecture!
        </p>';
        $this->view->renderSection('Implementasi Selesai', $content);
    }
}