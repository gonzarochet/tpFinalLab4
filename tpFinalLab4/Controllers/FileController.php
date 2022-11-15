<?php namespace Controllers;

use Exception;

use Models\File as File;


class FileController{

    private $uploadFilePath;
    private $allowedExtensions;
    private $maxSize;

    private $FileDAO; 


    public function __construct()
    {
        $this->allowedExtensions = array('png','jpg','jpeg','gif','mp4','pdf');
        $this->maxSize = 100000000;
        $this->uploadFilePath = UPLOADS_PATH;
    }

    public function ShowImage($idfile){

    }

    public function ShowFile($idFile){

    }

    public function Upload($file,$type=null){
        try{
            $flag = null;

            $fileToSave = new File($file['nameFile'],$file['typeFile'],$file['sizeFile'],$file['tmp_nameFile'],$file['fullPath']);
            
            $fileName = $fileToSave->getNameFile();

            //nombre del fichero temporal que se utiliza para almacenar 
            //en el servido el archivo recibido.
            $tempFileName = $fileToSave->getTmpName();
            $fileType = $fileToSave->getTypeFile();

            $filePath = $this->uploadFilePath."$type/";

            if(!file_exists($filePath)){
                mkdir($filePath);
            }

            //Ruta completa del archivo. 
            $fileLocation = $filePath.$fileName;

            //extension del archivo.
            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

           // $fileSize = getimagesize($tempFileName);

            if(in_array($fileType,$this->allowedExtensions)){
                if(!file_exists($fileLocation)){
                    if($fileToSave->getSizeFile() < $this->maxSize){
                        if (move_uploaded_file($tempFileName, $filePath)){
                            //$this->FileDAO->Add($fileToSave);
                            $flag = $this->uploadFilePath."/".$type."/".$fileName;
                            $message = "File upload succesfully";
                        }else{
                            $message = "An error has been happened";
                            }
                        }else{
                            $message = "The size of the file is more bigger than 50mb";
                        }
                    }else{
                        $message = "The file already exists";
                    }
                }else{
                    $message = "The file extension is not available. Please the extension avaliables are: ". $this->allowedExtensions;
                }
            return $flag;
        }catch(Exception $ex){
            $message = $ex->getMessage();
        }
    }

   
}

?>