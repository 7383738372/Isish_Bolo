<?php
$fileName = 'sample.txt';

if (file_exists($fileName)) {
    echo "Isish Bolo.\n";
    
    $fileContents = file_get_contents($fileName);
    if ($fileContents === false) {
        echo "Error reading the file.\n";
    } else {
        echo "File contents:\n";
        echo $fileContents . "\n";  

        $lines = file($fileName, FILE_IGNORE_NEW_LINES);
        if ($lines === false) {
            echo "Error reading the file lines.\n";
        } else {
            echo "File lines:\n";
            foreach ($lines as $line) {
                echo $line . "\n";
            }
        }
    }
} else {
    echo "File does not exist.\n";
    
    $initialContent = "This is the initial content of the file.\n";
    $result = file_put_contents($fileName, $initialContent);
    if ($result === false) {
        echo "Error writing to the file.\n";
    } else {
        echo "File created and content written.\n";
        
        $fileContents = file_get_contents($fileName);
        if ($fileContents === false) {
            echo "Error reading the file.\n";
        } else {
            echo "New file contents after creation:\n";
            echo $fileContents . "\n";
        }
    }
}
?>
