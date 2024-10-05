<?php
// Інтерфейс ILoger
interface ILoger {
    public function log($message);
}

// Трейт для роботи з датою та часом
trait DateTimeTrait {
    public function getCurrentDateTime() {
        return date("F j, Y, g:i a");
    }
}

// Трейт для запису в файл
trait FileWriterTrait {
    private $file;

    public function openFile($filename, $mode = 'a') {
        $this->file = fopen($filename, $mode) or die('Could not open the log file');
    }

    public function writeToFile($message) {
        fwrite($this->file, $message);
    }

    public function closeFile() {
        if ($this->file) {
            fclose($this->file);
        }
    }
}

// Клас FileLoger, який реалізує інтерфейс та використовує трейти
class FileLoger implements ILoger {
    use DateTimeTrait, FileWriterTrait;

    private $logFile;

    public function __construct($filename, $mode = 'a') {
        $this->logFile = $filename;
        $this->openFile($filename, $mode);
    }

    public function log($message) {
        $dateTime = $this->getCurrentDateTime();
        $logMessage = $dateTime . ': ' . $message . "\n";
        $this->writeToFile($logMessage);
    }

    public function __destruct() {
        $this->closeFile();
    }
}

// Перевіряємо, чи було передано повідомлення через POST-запит
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $userMessage = trim($_POST['message']);  // Очищуємо введене повідомлення

    // Створюємо екземпляр FileLoger і записуємо повідомлення
    $FLog = new FileLoger('./log.txt', 'a');
    $FLog->log($userMessage);

    // Після запису перенаправляємо користувача на форму з підтвердженням
    header('Location: form.html');
    exit();
}
?>
