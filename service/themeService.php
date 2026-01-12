<?php

namespace service;

use Modele\Entity\Theme;
use Modele\Repository\themeRepository;

class themeService
{
    private themeRepository $themeRepository;

    public function __construct()
    {
        $this->themeRepository = new themeRepository();
    }

    public function affichaeTheme(Theme $theme)
    {
        $result = $this->themeRepository->affichaeTheme($theme);
        return $result;
    }

    public function addOrUpdateTheme(Theme $theme)
    {
        if ($theme->getId()) {
            $result = $this->themeRepository->UpdateTheme($theme);
            if ($result)
                return $result ? "update" : false;
        } else {
            $result = $this->themeRepository->addTheme($theme);
            if ($result)
                return $result ? "add" : false;
        }
    }

    public function findThemeById(Theme $theme)
    {
        $result = $this->themeRepository->findThemeById($theme);
        if ($result)
            return $result;
        return false;
    }

    public function deleteThemeById(Theme $theme)
    {
        $result = $this->themeRepository->findThemeById($theme);
        if ($result) {
            $deleteResult = $this->themeRepository->deleteThemeById($theme);
            return $deleteResult;
        }
        return false;
    }

    public function publicThemes()
    {
        $result = $this->themeRepository->publicThemes();
        if ($result)
            return $result;
        return false;
    }
}
