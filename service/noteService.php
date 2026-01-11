<?php

namespace service;

use Modele\Entity\note;
use Modele\Repository\noteRepository;

class noteService
{

    private noteRepository $noteRepository;

    public function __construct()
    {
        $this->noteRepository  = new noteRepository();
    }


    public function affichaeNote(note $note)
    {
        $result = $this->noteRepository->affichaeNote($note);
        return $result;
    }

    public function addOrUpdateNote(note $note)
    {
        if ($note->getId()) {
            $result = $this->noteRepository->UpdateNote($note);
            if ($result)
                return $result ? "update" : false;
        } else {
            $result = $this->noteRepository->addNote($note);
            if ($result)
                return $result ? "add" : false;
        }
    }

    public function findNoteById(note $note)
    {
        $result = $this->noteRepository->findNoteById($note);
        if ($result)
            return $result;
        return false;
    }

    public function deleteNoteById(note $note)
    {
        $result = $this->noteRepository->findNoteById($note);
        if ($result) {
            $deleteResult = $this->noteRepository->deleteNoteById($note);
            return $deleteResult;
        }
        return $result;
    }

    public function ratingNote(note $note)
    {
        $result = $this->noteRepository->ratingNote($note);
        return $result;
    }
}
