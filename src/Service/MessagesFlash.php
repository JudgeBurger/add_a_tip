<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessagesFlash extends AbstractController
{
    const MESSAGE_FLASH = [
        'create' => 'Création effectuée',
        'delete' => 'Suppression effectuée',
        'update' => 'Mise à jour effectuée',
        'denied' => 'YOU SHALL NOT PASS!!',
    ];

    public function messageFlash(string $type)
    {
        return $this->addFlash($type, (string) self::MESSAGE_FLASH[$type]);
    }
}
