<?php
// ===== PROJECT LOADER - Semua Class Definition =====

// ========== NAMESPACE: ProjectApp\Model ==========
namespace ProjectApp\Model {
    use ProjectApp\Trait\LoggerTrait;

    // Interface untuk Polymorphism
    interface Describable {
        public function getInfo(): string;
    }

    // ===== CLASS PROJECT (Parent) =====
    class Project implements Describable {
        use LoggerTrait;
        
        public string $name;
        private string $deadline;
        protected array $tasks = [];
        
        const STATUS_ACTIVE = "Active";
        const STATUS_DONE = "Done";
        const STATUS_PENDING = "Pending";
        
        public function __construct(string $name, string $deadline) {
            $this->name = $name;
            $this->deadline = $deadline;
        }
        
        public function getDeadline(): string {
            return $this->deadline;
        }
        
        public function setDeadline(string $deadline): void {
            $this->deadline = $deadline;
        }
        
        public function addTask(string $taskName): void {
            $this->tasks[] = $taskName;
        }
        
        public function __toString(): string {
            return "Project: {$this->name} (Deadline: {$this->deadline})";
        }
        
        public function __get(string $name) {
            if ($name === 'deadline') {
                return $this->deadline;
            }
            return null;
        }
        
        public function getInfo(): string {
            return "Project: {$this->name} | Deadline: {$this->deadline}";
        }
        
        public static function getType(): string {
            return static::class;
        }
        
        public function __destruct() {
        }
    }
    
    // ===== CLASS TASK (Child) =====
    class Task extends Project {
        public string $taskTitle;
        private Project $parentProject;
        
        public function __construct(string $taskTitle, Project $parentProject) {
            parent::__construct("Task: $taskTitle", "Inherit from parent");
            $this->taskTitle = $taskTitle;
            $this->parentProject = $parentProject;
            $this->parentProject->addTask($taskTitle);
        }
        
        public function getInfo(): string {
            return "Task: {$this->taskTitle} untuk project '{$this->parentProject->name}'";
        }
        
        public function getStatus(): string {
            return parent::STATUS_DONE;
        }
    }
    
    // ===== CLASS SPRINT (Child) =====
    class Sprint extends Project {
        protected int $durationDays;
        
        public function __construct(string $name, string $deadline, int $durationDays) {
            parent::__construct($name, $deadline);
            $this->durationDays = $durationDays;
        }
        
        public function getDuration(): int {
            return $this->durationDays;
        }
        
        public function getInfo(): string {
            return "Sprint: {$this->name} | Duration: {$this->durationDays} hari | Deadline: {$this->getDeadline()}";
        }
        
        final public function performReview(): string {
            return "Sprint review untuk {$this->name} telah dilakukan.";
        }
        
        public static function getType(): string {
            return "Sprint Type: " . static::class;
        }
    }
}

// ========== NAMESPACE: ProjectApp\Service ==========
namespace ProjectApp\Service {
    use ProjectApp\Model\Project;
    use ProjectApp\Exception\ProjectException;
    use ArrayIterator;
    use IteratorAggregate;
    use Traversable;

    class ProjectManager implements IteratorAggregate {
        public string $teamName;
        private array $projects = [];
        private object $notifier;
        private static int $managerCount = 0;
        
        public function __construct(string $teamName, object $notifier) {
            $this->teamName = $teamName;
            $this->notifier = $notifier;
            self::$managerCount++;
        }
        
        public function addProject(Project $project): void {
            $this->projects[$project->name] = $project;
        }
        
        public function getAllProjects(): array {
            return $this->projects;
        }
        
        public function removeProject(string $name): void {
            if (!isset($this->projects[$name])) {
                throw new ProjectException("Project '$name' tidak ditemukan!");
            }
            unset($this->projects[$name]);
        }
        
        public static function getTotalManagers(): int {
            return self::$managerCount;
        }
        
        public function __toString(): string {
            return "ProjectManager: {$this->teamName} dengan " . count($this->projects) . " project";
        }
        
        public function __call(string $method, array $args) {
            if (str_starts_with($method, 'notify')) {
                $message = $args[0] ?? 'No message';
                $this->notifier->send($message);
                return;
            }
        }
        
        public function __sleep(): array {
            return ['teamName', 'projects'];
        }
        
        public function __wakeup(): void {
        }
        
        public function __clone(): void {
            $clonedProjects = [];
            foreach ($this->projects as $name => $project) {
                $clonedProjects[$name] = clone $project;
            }
            $this->projects = $clonedProjects;
        }
        
        public function getIterator(): Traversable {
            return new ArrayIterator($this->projects);
        }
    }
}

// ========== NAMESPACE: ProjectApp\Exception ==========
namespace ProjectApp\Exception {
    use Exception;
    
    class ProjectException extends Exception {
        public function __construct(string $message) {
            parent::__construct($message);
        }
    }
}

// ========== NAMESPACE: ProjectApp\Trait ==========
namespace ProjectApp\Trait {
    trait LoggerTrait {
        public function logActivity(string $activity): void {
            echo "[LOG] {$activity} - " . date('Y-m-d H:i:s') . "\n";
        }
    }
}

// ========== NAMESPACE: ProjectApp\Report ==========
namespace ProjectApp\Report {
    use ProjectApp\Model\Project;
    
    final class FinalReport {
        final public function generateReport(Project $project): void {
            echo "=== LAPORAN FINAL ===\n";
            echo "Project: {$project->name}\n";
            echo "Deadline: {$project->getDeadline()}\n";
            echo "Status: Laporan telah dibuat (final class)\n";
        }
    }
}

// ========== NAMESPACE: ProjectApp\Team ==========
namespace ProjectApp\Team {
    interface Workable {
        public function work(): void;
    }
    
    class Developer implements Workable {
        public function work(): void {
            echo "Developer sedang coding aplikasi...\n";
        }
    }
    
    class Designer implements Workable {
        public function work(): void {
            echo "Designer sedang membuat UI/UX...\n";
        }
    }
}

// ========== NAMESPACE BERBEDA DENGAN NAMA CLASS SAMA ==========
namespace ProjectApp\Internal {
    class Task {
        private string $title;
        
        public function __construct(string $title) {
            $this->title = $title;
        }
        
        public function getTaskInfo(): string {
            return "Internal Task: {$this->title}";
        }
    }
}

namespace ProjectApp\External {
    class Task {
        private string $title;
        
        public function __construct(string $title) {
            $this->title = $title;
        }
        
        public function getTaskInfo(): string {
            return "External Task: {$this->title}";
        }
    }
}

// ========== MULAI SESSION & HTML OUTPUT ==========
namespace {
    session_start();
    
    use ProjectApp\Model\{Project, Task, Sprint};
    use ProjectApp\Service\ProjectManager;
    use ProjectApp\Exception\ProjectException;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System - OOP PHP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 { font-size: 2.5em; margin-bottom: 10px; }
        .header p { opacity: 0.9; font-size: 1.1em; }
        .content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            padding: 30px;
        }
        .form-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }
        .form-section h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 1.5em;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #495057;
            font-weight: 600;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
        .output-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
        }
        .output-section h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 1.5em;
        }
        .notification {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            animation: slideIn 0.5s ease-out;
            border-left: 4px solid;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .notification.success {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }
        .notification.error {
            background: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }
        .notification.info {
            background: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
        }
        .project-list {
            margin-top: 20px;
        }
        .project-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 4px solid #667eea;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .project-item h3 {
            color: #495057;
            margin-bottom: 5px;
        }
        .project-item p {
            color: #6c757d;
            font-size: 0.9em;
        }
        .project-item button {
            padding: 8px 15px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .project-item button:hover {
            background: #c82333;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }
        .badge-success { background: #28a745; color: white; }
        .badge-warning { background: #ffc107; color: #212529; }
        .badge-info { background: #17a2b8; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Project Management System</h1>
            <p>Demonstrasi 20 Konsep OOP PHP dengan CRUD Interaktif</p>
        </div>

        <div class="content">
            <!-- FORM SECTION -->
            <div class="form-section">
                <h2>📝 Input Project</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nama Project:</label>
                        <input type="text" name="project_name" placeholder="Contoh: Website Redesign" required>
                    </div>
                    <div class="form-group">
                        <label>Deadline:</label>
                        <input type="date" name="project_deadline" required>
                    </div>
                    <div class="form-group">
                        <label>Tipe Project:</label>
                        <select name="project_type" required>
                            <option value="project">Regular Project</option>
                            <option value="sprint">Sprint Project</option>
                        </select>
                    </div>
                    <div class="form-group" id="durationField" style="display:none;">
                        <label>Durasi Sprint (hari):</label>
                        <input type="number" name="sprint_duration" placeholder="14" min="1">
                    </div>
                    <button type="submit" name="action" value="create" class="btn btn-primary">
                        ➕ Tambah Project
                    </button>
                </form>

                <h2 style="margin-top: 30px;">🗑️ Hapus Project</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nama Project:</label>
                        <input type="text" name="delete_name" placeholder="Nama project yang akan dihapus" required>
                    </div>
                    <button type="submit" name="action" value="delete" class="btn btn-danger">
                        🗑️ Hapus Project
                    </button>
                </form>
            </div>

            <!-- OUTPUT SECTION -->
            <div class="output-section">
                <h2>📊 Output & Notifikasi</h2>
                
                <?php
                // Inisialisasi session untuk menyimpan projects
                if (!isset($_SESSION['projects'])) {
                    $_SESSION['projects'] = [];
                }
                
                // Anonymous Class untuk Notifikasi
                $notifier = new class {
                    public function send(string $message, string $type = 'success'): void {
                        echo "<div class='notification {$type}'>";
                        echo "<strong>🔔 Notifikasi:</strong> {$message}";
                        echo "</div>";
                    }
                };
                
                // Buat Project Manager dengan Dependency Injection
                $manager = new ProjectManager("Development Team", $notifier);
                
                // Load projects dari session
                foreach ($_SESSION['projects'] as $proj) {
                    if ($proj['type'] === 'sprint') {
                        $p = new Sprint($proj['name'], $proj['deadline'], $proj['duration']);
                    } else {
                        $p = new Project($proj['name'], $proj['deadline']);
                    }
                    $manager->addProject($p);
                }
                
                // Handle CRUD Operations
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $action = $_POST['action'] ?? '';
                    
                    // CREATE
                    if ($action === 'create') {
                        $name = htmlspecialchars($_POST['project_name']);
                        $deadline = $_POST['project_deadline'];
                        $type = $_POST['project_type'];
                        
                        $exists = false;
                        foreach ($_SESSION['projects'] as $proj) {
                            if ($proj['name'] === $name) {
                                $exists = true;
                                break;
                            }
                        }
                        
                        if ($exists) {
                            $notifier->send("Project '{$name}' sudah ada!", 'error');
                        } else {
                            $projectData = [
                                'name' => $name,
                                'deadline' => $deadline,
                                'type' => $type,
                                'duration' => $type === 'sprint' ? intval($_POST['sprint_duration'] ?? 14) : 0
                            ];
                            
                            $_SESSION['projects'][] = $projectData;
                            
                            if ($type === 'sprint') {
                                $newProject = new Sprint($name, $deadline, $projectData['duration']);
                            } else {
                                $newProject = new Project($name, $deadline);
                            }
                            $manager->addProject($newProject);
                            $manager->notifyTeam("Project '{$name}' berhasil ditambahkan!");
                            
                            $notifier->send("Project '{$name}' berhasil ditambahkan! 🎉", 'success');
                        }
                    }
                    
                    // DELETE
                    if ($action === 'delete') {
                        $deleteName = htmlspecialchars($_POST['delete_name']);
                        
                        try {
                            $manager->removeProject($deleteName);
                            
                            $_SESSION['projects'] = array_filter($_SESSION['projects'], function($proj) use ($deleteName) {
                                return $proj['name'] !== $deleteName;
                            });
                            $_SESSION['projects'] = array_values($_SESSION['projects']);
                            
                            $notifier->send("Project '{$deleteName}' berhasil dihapus! 🗑️", 'info');
                        } catch (ProjectException $e) {
                            $notifier->send($e->getMessage(), 'error');
                        }
                    }
                }
                ?>
                
                <!-- Welcome Message -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; text-align: center;">
                    <h2 style="margin: 0 0 10px 0; font-size: 1.8em;">👋 Selamat Datang!</h2>
                    <p style="margin: 0; font-size: 1.2em; opacity: 0.95;">
                        <strong>Manager/Team:</strong> <?php echo htmlspecialchars($manager->teamName); ?>
                    </p>
                    <p style="margin: 5px 0 0 0; font-size: 0.95em; opacity: 0.85;">
                        📅 <?php echo date('d F Y, H:i'); ?> WIB
                    </p>
                </div>
                
                <!-- Daftar Projects -->
                <div class="project-list">
                    <h3>📋 Daftar Project <span class="badge badge-info"><?php echo count($_SESSION['projects']); ?> Project</span></h3>
                    
                    <?php if (empty($_SESSION['projects'])): ?>
                        <p style="color: #6c757d; margin-top: 15px;">Belum ada project. Tambahkan project baru di form sebelah kiri!</p>
                    <?php else: ?>
                        <?php foreach ($_SESSION['projects'] as $proj): ?>
                            <div class="project-item">
                                <div>
                                    <h3><?php echo htmlspecialchars($proj['name']); ?>
                                        <?php if ($proj['type'] === 'sprint'): ?>
                                            <span class="badge badge-warning">Sprint</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Regular</span>
                                        <?php endif; ?>
                                    </h3>
                                    <p>📅 Deadline: <?php echo $proj['deadline']; ?>
                                        <?php if ($proj['type'] === 'sprint'): ?>
                                            | ⏱️ Durasi: <?php echo $proj['duration']; ?> hari
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <form method="POST" style="margin: 0;">
                                    <input type="hidden" name="delete_name" value="<?php echo htmlspecialchars($proj['name']); ?>">
                                    <button type="submit" name="action" value="delete">Hapus</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                

            </div>
        </div>
    </div>

    <script>
        document.querySelector('select[name="project_type"]').addEventListener('change', function() {
            const durationField = document.getElementById('durationField');
            if (this.value === 'sprint') {
                durationField.style.display = 'block';
                document.querySelector('input[name="sprint_duration"]').required = true;
            } else {
                durationField.style.display = 'none';
                document.querySelector('input[name="sprint_duration"]').required = false;
            }
        });
    </script>
</body>
</html>
<?php
}
?>