<?php

namespace Modele\Repository;

use Database\DataBaseConnection;
use Modele\Entity\Report;
use PDO;

class reportRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = DataBaseConnection::getConnection();
    }

    public function getAllReports(Report $Report)
    {
        $sql = "
            SELECT * FROM report where 1 = 1
        ";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateReport(Report $Report)
    {
        $sql = "UPDATE report SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':status' => $Report->getStatus(),
            ':id' => $Report->getId()
        ]);
    }
}
