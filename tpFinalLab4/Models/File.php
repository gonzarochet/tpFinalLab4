<?php 
namespace Models;

class File{
    private $name;
    private $type;
    private $size;
    private $tmp_name;
    private $error;
    private $fullPath;


    public function __construct($name="",$fullPath="",$type="",$error="",$tmp_name="",$size=""){
        $this->name = $name;
        $this->type = $type;
        $this->size = $size;
        $this->error = $error;
        $this->tmp_name = $tmp_name;
        $this->fullPath = $fullPath;

    }


    public function getName(){
        return $this->name;
    }

    public function setName($newNameFile){
        $this->name = $newNameFile;
    }

    public function getType(){
        return $this->type;

    }

    public function setType($newTypeFile){
        $this->type = $newTypeFile;
    }

    public function getSize(){
        return $this->size;
    }
    
    public function setSize($newSizeFile){
        $this->size = $newSizeFile;
    }

    public function getTmpName(){
        return $this->tmp_name;
    }

    public function setTmpName($tmp_nameFile){
        $this->tmp_name = $tmp_nameFile;
    }

    public function getFullPath(){
        return $this->fullPath;
    }

    public function setFullPath($newFullPath){
        $this->fullPath = $newFullPath;
    }

    public function getError(){
        return $this->error;

    }
    public function setError($newError){
        $this->error = $newError;
    }



}



?>