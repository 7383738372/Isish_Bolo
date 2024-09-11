<?php
$fileName = 'sample.txt';

if (file_exists($fileName)) {
    echo "Isish Luvly.\n";
    
    $fileContents = file_get_contents($fileName);
    echo "BSIT-3G:\n";
    echo $fileContents . "\n";  

    $lines = file($fileName, FILE_IGNORE_NEW_LINES);
    echo "File lines:\n";
    foreach ($lines as $line) {
        echo $line . "\n";
    }
} else {
    echo "File does not exist.\n";
    
    $initialContent = "This is the initial content of the file.\n";
    file_put_contents($fileName, $initialContent);
    echo "File created and content written.\n";
    
    $fileContents = file_get_contents($fileName);
    echo "New file contents after creation:\n";
    echo $fileContents . "\n";
}
?>
