<?php

/**
 * 文件目录操作
 *
 * @author joy
 */
class FileHandler {

    static function createFolder($path) {
        if (!file_exists($path)) {
            self::createFolder(dirname($path));
            mkdir($path, 0777);
        }
        return true;
    }

    static function updateFile($fileData, $filePath, $fileName) {
        if (!file_exists($filePath)) {
            //my_log($filePath);
            self::createFolder($filePath);
        }

        $fileName = $filePath . "/" . $fileName;
        $file = fopen($fileName, "w");
        fwrite($file, $fileData);
        fclose($file);
        return true;
    }

    static function readFileContent($fullpath) {
        return file_get_contents($fullpath);
    }

    static function deleteFile($fullpath) {
        if (!is_dir($fullpath)) {
            unlink($fullpath);
        } else {
            deldir($fullpath);
        }
    }

    /**
     * 去目录下文件列表（包括子目录）
     * @staticvar int $i
     * @param type $dir
     * @param type $max 最大列表长度
     * @param type $mask 匹配文件格式，如 ：.php$|.txt$ 
     * @return array
     */
    static function ls($dir, $max = null, $mask = null) {
        $files = Array();
        $d = opendir($dir);
        while ($file = readdir($d)) {
            if ($file == '.' || $file == '..')
                continue;

            if (is_dir($dir . '/' . $file)) {
                $files += self::ls($dir . '/' . $file,$max, $mask);
                continue;
            }

            if ($mask != null && !eregi($mask, $file)) {
                continue;
            }

            $files[] = $dir . '/' . $file;
            if ($max > 0 && count($files) >= $max) {
                closedir($d);
                return $files;
            }
        }
        closedir($d);
        return $files;
    }
}

?>
