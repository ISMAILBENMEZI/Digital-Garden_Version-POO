<?php

namespace Controller;

use Modele\Entity\Report;
use service\reportService;

class ReportController
{

    private reportService $reportService;

    public function __construct()
    {
        $this->reportService = new reportService();
    }

    public function getAllReports()
    {
        $Report = new Report(
            report_type: null,
            status: null,
            reporter_name: null,
            reported_user_id: null,
            report_theme_id: null
        );

        $Reports = $this->reportService->getAllReports($Report);

        if ($Reports) {
            $_SESSION['reports'] = $Reports;
            return true;
        }
        return false;
    }


    public function updateReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['report_id'];
            $statut = $_POST['status'];
            $allowed = ['pending', 'under_review', 'resolved', 'dismissed'];

            $Report = new Report(
                report_type: null,
                status: $statut,
                reporter_name: null,
                reported_user_id: null,
                report_theme_id: null,
                id: $id
            );

            if (in_array($statut, $allowed)) {
                $result = $this->reportService->updateReport($Report);

                if ($result) {
                    $_SESSION['success'] = 'update statut successfull';
                    return true;
                }
                $_SESSION['error'] = 'error. Please try again later.';
                return false;
            }
        }
    }
}
