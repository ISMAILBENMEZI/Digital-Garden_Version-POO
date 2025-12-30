<?php

class Theme{
    private $id;
    private $title;
    private $color;

    public function __construct($title , $color)
    {
        $this->title = $title;
        $this->color = $color;
    }


    public function __get($propriete)
    {
        return $this->$propriete;
    }

    public function setId($id)
    {
        if($id > 0)
        {
            $this->id = $id;
        }
        else{
            throw new InvalidArgumentException("Invalid ID");
        }
    }

    public function setTitle($title)
    {
        if(strlen($title) <= 20)
        {
            $this->title = $title;
        }
        else{
            throw new InvalidArgumentException("The title must not exceed 15 characters");
        }
    }

    public function setColor($color)
    {
        if(preg_match('/^#[a-fA-F0-9]{6}$/', $color))
        {
            $this->color = $color;
        }
        else{
            throw new InvalidArgumentException("Invalid color");
        }
    }
}