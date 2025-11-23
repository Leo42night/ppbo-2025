<?php
namespace PerpustakaanApp\Services;

use PerpustakaanApp\Models\Library;
use PerpustakaanApp\Models\Exceptions\LibraryException;
use Exception;

class LibraryService {
    private Library $library;
    
    public function __construct(Library $library) {
        $this->library = $library;
    }
    
    public function borrowItem(string $itemId, string $memberName): string {
        try {
            $item = $this->library->getItem($itemId);
            
            if (!$item) {
                throw new LibraryException("Item with ID {$itemId} not found");
            }
            
            if (!$item->isAvailable()) {
                throw new LibraryException("Item is already borrowed");
            }
            
            if ($item->borrow($memberName)) {
                return "Successfully borrowed: {$item->getTitle()}";
            }
            
            throw new LibraryException("Failed to borrow item");
            
        } catch (LibraryException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Unexpected error: " . $e->getMessage();
        } finally {
            error_log("Borrow attempt for item: {$itemId}");
        }
    }
    
    public function getLibrary(): Library {
        return $this->library;
    }
}