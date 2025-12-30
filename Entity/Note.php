<?php


class note
{
    private $id;
    private $title;
    private $content;
    private $rating;

    public function __construct($title, $content, $rating)
    {
        $this->title = $title;
        $this->content = $content;
        $this->rating = $rating;
    }


    public function __get($propriete)
    {
        return $this->$propriete;
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

    public function setContent($content)
    {
        if(strlen($content) <= 500)
        {
            $this->content = $content;
        }
        else{
            throw new InvalidArgumentException("The content must not exceed 500 characters");
        }
    }

    public function setRating($rating)
    {
        if($rating <= 5)
        {
            $this->rating = $rating;
        }
        else{
            throw new InvalidArgumentException("Rating must be between 0 and 5.");
        }
}
}
