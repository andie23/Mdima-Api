<?php
namespace App\Lib;

class Uploads
{
    static $MAX_SIZE = 8000000;

    public function upload($dir, $file, $validFileTypes)
    {
       if (! $ext = $this->checkFileType($file, $validFileTypes)) 
       {
          throw new \Exception("Uploaded file is not supported by the system.");
       } 
    
       if ($this->checkSize($file)){
           throw new \Exception(__('File is exceeding limit of {0} bytes', static::$MAX_SIZE));
       }
       
       $filePath = $this->moveFile($dir, $file);
       
       if (! $filePath) {
            throw new \Exception("File could not be uploaded. Please contact system administrator");
       } 
       return [
          'path' => $filePath,
          'type' => $validFileTypes[$ext]
       ];
    }
    
    private function checkSize($file)
    {
        return $file['size'] > static::$MAX_SIZE; 
    }

    private function checkFileType($file, $validFileTypes)
    {
        $ext = $this->getExtension($file['name']);
        if (array_key_exists($ext, $validFileTypes)){
            return $ext;
        }
        return null;
    }

    public function getExtension($fileName)
    {
        $nameArray = explode('.', $fileName);
        $extIndex = sizeof($nameArray) - 1;
        $ext = $nameArray[$extIndex];
        return strtolower($ext);
    }

    private function moveFile($dir, $file)
    {
        $dirPath = $dir['fullPath']; 
        $filePath = $dir['fullPath'] . '\\' . $file['name'] ;
        $relativeFilePath = '/' . $dir['dir'] . '/' . $file['name'];
     
        if(! is_dir($dirPath)) {
            mkdir($dirPath);
        }

        if (move_uploaded_file($file['tmp_name'], $filePath)){
            // Relative path to the file, using UNIX-style file separator
            return $relativeFilePath;
        }

        throw new \Exception(__('An error was detected with the uploaded file. Verify that it is not corrupt or is valid'));
    }
}