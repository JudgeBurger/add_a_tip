<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessagesFlash extends AbstractController
{
    const MESSAGE_FLASH = [
        'create' => 'Votre tip à été crée avec succès',
        'delete' => 'Votre tip à été supprimé avec succès',
        'update' => 'Votre tip à été mit à jour avec succès',
        'denied' => 'YOU SHALL NOT PASS!!',
    ];

    /**
     * @param string $type
     */
    public function messageFlash(string $type)
    {
        return $this->addFlash($type, (string) self::MESSAGE_FLASH[$type]);
    }
}
