<?php
class Book{
    private $title;
    private $isbn13;
    private $price;

    function __contruct($title,$isbn13,$price){
        $this->title=$title;
        $this->isbn13=$isbn13;
        $this->price=$price;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title=$title
    }
}
?>