<?php

namespace app\core;

use Gumlet\ImageResize;


class UploadedFile extends Object

{
    private static $_files;
    public         $extension;
    public         $oldName;
    public         $name;
    public         $tempName;
    public         $type;
    public         $size;
    public         $error;
    public         $mackUpload;
    private        $mackUploadDefault = [
      'full'    => [
        'path'    => '',
        'width'   => 900,
        'toWidth' => true,
      ],
      'preview' => [
        'path'    => 'preview',
        'width'   => 300,
        'toWidth' => true,
      ],
      'small'   => [
        'path'    => 'small',
        'width'   => 90,
        'toWidth' => true,
      ],
    ];

    public static function getImage($name)
    {
        $files = self::loadFiles();

        return isset($files[$name]) ? new static($files[$name]) : null;
    }

    private static function loadFiles()
    {
        if (self::$_files === null) {
            self::$_files = [];
            if (isset($_FILES) && is_array($_FILES)) {
                foreach ($_FILES as $class => $info) {
                    self::loadFilesRecursive($class, $info['name'], $info['tmp_name'], $info['type'], $info['size'],
                      $info['error']);
                }
            }
        }

        return self::$_files;
    }

    private static function loadFilesRecursive($key, $names, $tempNames, $types, $sizes, $errors)
    {
        if (is_array($names)) {
            foreach ($names as $i => $name) {
                self::loadFilesRecursive($key . '[' . $i . ']', $name, $tempNames[$i], $types[$i], $sizes[$i],
                  $errors[$i]);
            }
        } elseif ((int)$errors !== UPLOAD_ERR_NO_FILE) {
            self::$_files[$key] = [
              'name'      => $names,
              'tempName'  => $tempNames,
              'type'      => $types,
              'size'      => $sizes,
              'error'     => $errors,
              'extension' => substr($names, strrpos($names, '.')+1)
            ];
        }
    }


    public static function getImages($name)
    {
        $files = self::loadFiles();
        if (isset($files[$name])) {
            return [new static($files[$name])];
        }
        $results = [];
        foreach ($files as $key => $file) {
            if (strpos($key, "{$name}[") === 0) {
                $results[] = new static($file);
            }
        }

        return $results;
    }

    public function uploadImage($name, $imageUploadPath)
    {
        $dir        = WEB_ROOT . $imageUploadPath;
        $this->name = $name . '.'. $this->extension;
        if (!isset($this->mackUpload)) {
            $this->mackUpload = $this->mackUploadDefault;
        }
        foreach ($this->mackUpload as $mask) {
            $this->editImage($mask, $dir);
        }

        return $this;
    }

    public function editImage($mask, $dir)
    {
        $path = trim($mask['path'], '/') . '/';
        $dir  = $dir . $path;
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        if ( file_exists($dir . $this->oldName) && is_file($dir. $this->oldName)) {
            unlink($dir . $this->oldName);
        }

        $image = new ImageResize($this->tempName);
        if ($mask['toWidth']) {
            $image->resizeToWidth($mask['width']);
        }
        $image->save($dir . $this->name);
    }

    public static function deleteFile($name, $imageUploadPath)
    {
        $file = new UploadedFile();
        $_dir = WEB_ROOT . $imageUploadPath;
        if (!isset($file->mackUpload)) {
            $file->mackUpload = $file->mackUploadDefault;
        }
        foreach ($file->mackUpload as $mask) {
            $path = trim($mask['path'], '/') . '/';
            $dir  = $_dir . $path . $name;
            if (file_exists($dir) && is_file($dir)) {
                unlink($dir);
            }
        }

    }


}