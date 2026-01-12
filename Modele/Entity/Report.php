<?php

namespace Modele\Entity;

class Report
{
    private $id;
    private $report_type;
    private $status;
    private $reporter_name;
    private $reported_user_id;
    private $report_theme_id;

    public function __construct($report_type, $status, $reporter_name, $reported_user_id, $report_theme_id, $id = null)
    {
        $this->report_type = $report_type;
        $this->status = $status;
        $this->reporter_name = $reporter_name;
        $this->reported_user_id = $reported_user_id;
        $this->report_theme_id = $report_theme_id;
        $this->id = $id;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getReportType()
    {
        return $this->report_type;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getReporterName()
    {
        return $this->reporter_name;
    }

    public function getReportedUserId()
    {
        return $this->reported_user_id;
    }

    public function getReportThemeId()
    {
        return $this->report_theme_id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setReportType($report_type)
    {
        $this->report_type = $report_type;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setReporterName($reporter_name)
    {
        $this->reporter_name = $reporter_name;
    }

    public function setReportedUserId($reported_user_id)
    {
        $this->reported_user_id = $reported_user_id;
    }

    public function setReportThemeId($report_theme_id)
    {
        $this->report_theme_id = $report_theme_id;
    }
}
