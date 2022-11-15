<?php 
namespace Models;

class File{
    private $nameFile;
    private $typeFile;
    private $sizeFile;
    private $tmp_nameFile;
    private $fullPath;


    public function __construct($nameFile ,$typeFile,$sizeFile,$tmp_nameFile,$fullPath){
        $this->nameFile = $nameFile;
        $this->typeFile = $typeFile;
        $this->sizeFile = $sizeFile;
        $this->tmp_nameFile = $tmp_nameFile;
        $this->fullPath = $fullPath;

    }


    public function getNameFile(){
        return $this->nameFile;
    }

    public function setNameFile($newNameFile){
        $this->nameFile = $newNameFile;
    }

    public function getTypeFile(){
        return $this->typeFile;

    }

    public function setTypeFile($newTypeFile){
        $this->typeFile = $newTypeFile;
    }

    public function getSizeFile(){
        return $this->sizeFile;
    }
    
    public function setSizeFile($newSizeFile){
        $this->sizeFile = $newSizeFile;
    }

    public function getTmpName(){
        return $this->tmp_nameFile;
    }

    public function setTmpName($tmp_nameFile){
        $this->tmp_nameFile = $tmp_nameFile;
    }

    public function getFullPath(){
        return $this->fullPath;
    }

    public function setFullPath($newFullPath){
        $this->fullPath = $newFullPath;
    }



}



?>