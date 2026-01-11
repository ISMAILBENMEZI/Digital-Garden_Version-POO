<?php

namespace Modele\Entity;
use InvalidArgumentException;

class Theme
{
    private $id;
    private $title;
    private $color;
    private $user_id;

    public function __construct($title, $color, $user_id, $id)
    {
        $this->title = $title;
        $this->color = $color;
        $this->user_id = $user_id;
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        if ($user_id > 0) {
            $this->user_id = $user_id;
        } else {
            throw new InvalidArgumentException("Invalid ID");
        }
    }

    public function setId($id)
    {
        if ($id > 0) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException("Invalid ID");
        }
    }

    public function setTitle($title)
    {
        if (strlen($title) <= 20) {
            $this->title = $title;
        } else {
            throw new InvalidArgumentException("The title must not exceed 15 characters");
        }
    }

    public function setColor($color)
    {
        if (preg_match('/^#[a-fA-F0-9]{6}$/', $color)) {
            $this->color = $color;
        } else {
            throw new InvalidArgumentException("Invalid color");
        }
    }
}
