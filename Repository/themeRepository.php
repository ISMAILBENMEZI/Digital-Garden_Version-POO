<?php

class themeRepository
{

    private $conn;

    public function __construct(DataBaseConnection $db)
    {
        $this->conn = $db->getConnection();
    }

    public function addOrUpdateTheme(Theme $theme)
    {
        if ($theme->id) {
            $query = "UPDATE theme SET Color = :Color , name = :name WHERE id = :id AND  user_id = :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ":Color" => $theme->color,
                ":name" => $theme->title,
                ":id" => $theme->id,
                ":user_id" => $theme->user_id
            ]);

            unset($_SESSION['updateId'], $_SESSION['updateTitle'], $_SESSION['updateColor'], $_SESSION['Update']);
            $_SESSION['success'] = "Theme updated successfully";
            header("location:../public/userDashboard");
            exit();
        }


        $query = "INSERT INTO theme(name , Color , user_id) VALUES(:name,:Color,:user_id)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ":name" => $theme->title,
            ":Color" => $theme->color,
            ":user_id" => $theme->user_id
        ]);

        $_SESSION['success'] = 'Theme created successfully';
        header("location:../public/userDashboard");
        exit();
    }
}
