<?php

/**
 * @param $directory
 */
function listDirectory($directory)
{
    if (is_dir($directory)) {
        if ($directoryHandle=opendir($directory)) {
            echo '<ul>';
            while (($file = readdir($directoryHandle)) !== false) {
                if ($file == '..' || $file == '.' || $file == 'index.php') {
                    continue;
                }
                else {
                    if (is_dir("$directory/$file")) {
                        echo "<li>$file <a href='?delete=$directory/$file'><img class='delete' src='../assets/images/delete.png' alt='delete'></a></li>";
                        listDirectory("$directory/$file");
                    }
                    else {
                        echo "<li><a href='?file=$directory/$file'>$file</a> <a href='?delete=$directory/$file'><img class='delete' src='../assets/images/delete.png' alt='delete'></a></li>";
                    }
                }
            }
            echo '</ul>';
        }
    }
    else {
        echo 'Ce n\'est pas un dossier !';
    }
}

/**
 * @param $directory
 * @return bool
 */
function deleteDirectory($directory)
{
    if (is_dir($directory))
        $directoryHandle = opendir($directory);
    if (!$directoryHandle) {
        return false;
    }
    while ($file = readdir($directoryHandle)) {
        if ($file != '.' && $file != '..') {
            if (!is_dir($directory . '/'. $file)) {
                unlink($directory . '/' . $file);
            } else {
                deleteDirectory($directory . '/' . $file);
            }
        }
    }
    closedir($directoryHandle);
    rmdir($directory);
    return true;
}
