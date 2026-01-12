<?php

namespace service;

use Modele\Entity\Report;
use Modele\Repository\reportRepository;

class reportService
{
    private reportRepository $reportRepository;

    public function __construct()
    {
        $this->reportRepository = new reportRepository();
    }

    public function getAllReports(Report $Report)
    {
        $FindReports = $this->reportRepository->getAllReports($Report);

        if (!$FindReports)
            return false;
        return $FindReports;
    }
    public function updateReport(Report $Report)
    {
        $FindReport = $this->reportRepository->updateReport($Report);

        if ($FindReport)
            return $FindReport;
        return false;
    }
}
