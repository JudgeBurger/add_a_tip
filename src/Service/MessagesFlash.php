<?php

namespace App\Service;

class MessagesFlash
{
    public function create(string $data): string
    {
        return $data.'à été ajouté a votre collection.';
    }

    public function delete(string $data): string
    {
        return $data.'à été supprimé de votre collection.';
    }

    public function update(string $data): string
    {
        return $data.'à bien été modifié.';
    }
}
