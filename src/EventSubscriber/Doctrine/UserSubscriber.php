<?php

namespace App\EventSubscriber\Doctrine;

use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserSubscriber implements EventSubscriber
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            Events::prePersist => 'prePersist',
            Events::preUpdate => 'preUpdate',
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof User) {
            if (null === $entity->getEnabled()) {
                $entity->setEnabled(false);
            }

            if (null === $entity->getLocked()) {
                $entity->setLocked(false);
            }
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof User) {
            if (null != $entity->getNewPassword()) {
                $encoded = $this->encoder->encodePassword($entity, $entity->getNewPassword());
                $entity->setPassword($encoded);
            }
        }
    }
}
