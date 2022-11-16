<?php namespace Controllers;

use DAO\BD\FileDAOBD;
use Exception;

use Models\File as File;


class FileController{

    private $uploadFilePath;
    private $allowedExtensions;
    private $maxSize;
    private $FileDAO; 


    public function __construct()
    {
        $this->FileDAO = new FileDAOBD();
        $this->allowedExtensions = array('png','jpg','jpeg','gif','mp4','pdf');
        $this->maxSize = 100000000;
        $this->uploadFilePath = UPLOADS_PATH;
        
    }

    public function Upload($file,$type=null){
        try{
            
            $flag = null;
    
            $fileToSave = new File([$file['name']],"",$file['type'],$file['error'],$file['tmp_name'],$file['size']);
            
            $fileName = $file["name"];

            //nombre del fichero temporal que se utiliza para almacenar 
            //en el servido el archivo recibido.
            $tempFileName = $file['tmp_name'];

            $fileType = $file["type"];

            $filePath = $this->uploadFilePath."/$type/";

            if(!file_exists($filePath)){

                mkdir($filePath);
            }

            //Ruta completa del archivo. 
             $fileLocation = $filePath.$fileName;

            //extension del archivo.
             $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            if(in_array($fileExtension,$this->allowedExtensions)){
                if(!file_exists($fileLocation)){
                    if($fileToSave->getSize() < $this->maxSize){
                        if (move_uploaded_file($tempFileName, $fileLocation)){
                            $flag = $this->uploadFilePath."/".$type."/".$fileName;

                            $fileToSave->setFullPath($flag);
                            $fileToSave->setName($fileName);

                            $this->FileDAO->Add($fileToSave);
                            $message = "File upload succesfully";
                        }else{
                            $message = "An error has been happened";
                            }
                        }else{
                            $message = "The size of the file is more bigger than 50mb";
                        }
                    }else{
                        $flag = $this->uploadFilePath."/".$type."/".$fileName;
                    }
                }else{
                    $message = "The file extension is not available. Please the extensions avaliables are: ";
                }
            return $flag;
        }catch(Exception $ex){
            $message = $ex->getMessage();
        }
    }

   
}

?>