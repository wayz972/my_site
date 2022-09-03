<?php
namespace App\Classe;


 //je crée une class a part
class Search
{

   /**
     * @var string
     */
private $string="";

/**
     * @var Categories[]
     */
private $categories=[];



public function getString(){
     return $this->string;
}

public function setString($string){
     $this->string = $string;
}

public function getCategories(){
     return $this->categories;
}

public function setCategories($categories){
     $this->categories = $categories;
}

}