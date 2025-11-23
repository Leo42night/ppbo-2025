<?php
// ================= GLOBAL NAMESPACE =================
namespace {
    // ========== 1. Scope ==========
    // class Project {
    //     public string $name;
    //     private string $deadline;
    //     protected array $tasks = [];

    //     // ========== 2. Encapsulation ==========
    //     public function setDeadline(string $dl) { $this->deadline = $dl; }
    //     public function getDeadline(): string { return $this->deadline; }

    //     // ========== 3. Magic Methods ==========
    //     public function __construct($name) { $this->name = $name; }
    //     public function __toString(): string { return "Project: {$this->name}"; }
    //     public function __destruct() { echo "Project '{$this->name}' destroyed\n"; }
    // }

    // ========== 5. Class Constants ==========
    // class Status {
    //     const DONE = "Done";
    //     const TODO = "Not Done";
    // }

    // ========== 6. Late Static Binding ==========
    // class BaseUser {
    //     public static function role(): string { return "BaseUser"; }
    //     public static function whoAmI(): string { return static::role(); }
    // }
    // class ManagerUser extends BaseUser {
    //     public static function role(): string { return "Manager"; }
    // }

    // ========== 7. Final Keyword ==========
    // final class Report {
    //     final public function printReport(Project $p) {
    //         echo "Report: {$p}\n";
    //     }
    // }

    // ========== 8. Type Hinting ==========
    // function countTasks(array $tasks): int { return count($tasks); }

    // ========== 9. Exception Handling ==========
    // class Login {
    //     private $username = "admin";
    //     private $password = "123";
    //     public function masuk($u, $p) {
    //         if ($u !== $this->username || $p !== $this->password) {
    //             return "Login failed!";
    //         }
    //         return "Login success!";
    //     }
    // }

    // ========== 10. Trait ==========
    // trait Notification {
    //     public function send($msg) { echo "Notification: $msg\n"; }
    // }
    // class Team {
    //     use Notification;
    // }

    // // ========== 11. Polymorphism ==========
    // interface Role { public function work(); }
    // class Developer implements Role { public function work(){ echo "Coding...\n"; } }
    // class Designer implements Role { public function work(){ echo "Designing UI...\n"; } }

    // ========== 12. Static Method ==========
    // class Tools {
    //     public static function version() { return "Version 1.0"; }
    // }
}

// // ================= PROYEK NAMESPACE =================
// namespace Proyekku {
//     class Dummy {}
// }

// ================= BACK TO GLOBAL =================
namespace {
    // ========== 14. CRUD OOP ==========
    // class TaskCRUD {
    //     private array $data = [];
    //     public function add($t){ $this->data[] = $t; }
    //     public function all(){ return $this->data; }
    // }

    // --- DEMO OUTPUT ---
    // echo "<pre>"; // Semua output dibikin rapi

    // ========== 15. Serialization ==========
    // $p = new Project("Website");
    // $p->setDeadline("2025-12-31");
    // $ser = serialize($p);

    // // ========== 16. Object Iteration ==========
    // foreach(["Task1","Task2"] as $t){ echo "Iteration: $t\n"; }

    // ========== 17. Reflection ==========
    // $ref = new \ReflectionClass("Project");
    // echo "Project properties:\n";
    // foreach($ref->getProperties() as $prop){
    //     echo "- " . $prop->getName() . "\n";
    // }

    // ========== 18. Dependency Injection ==========
    // class WorkTeam {
    //     public function __construct(private \Role $r) {}
    //     public function work(){ $this->r->work(); }
    // }
    // $devTeam = new WorkTeam(new \Developer());

    // $devTeam->work();

    // // ========== 19. Cloning ==========
    // $clone = clone $p;

    // ========== 20. Anonymous Class ==========
    $anon = new class {
        public function hello(){ echo "Hello from secret team\n"; }
        public function info(){ echo "I am a team member.\n"; }
    };

    // echo "\n=== DEMO OUTPUT ===\n";
    // echo "Project: " . $p . "\n";
    // echo "Deadline: " . $p->getDeadline() . "\n";
    // echo "Serialized: $ser\n\n";

    // echo (new \Login())->masuk("admin","123")."\n";

    // $tcrud = new TaskCRUD();
    // $tcrud->add("Database"); 
    // $tcrud->add("UI Design");

    // echo "Total Task: " . \countTasks($tcrud->all()) . "\n";
    // echo "Tasks: " . implode(", ", $tcrud->all()) . "\n\n";

    // echo "User Role: " . \ManagerUser::whoAmI()."\n";
    // echo "Tools Version: " . \Tools::version()."\n\n";

    // $team = new \Team(); 
    // $team->send("New task added");


    $anon->hello();
    $anon->info();

    // echo "</pre>";
}
?>