<?php

namespace App\EventListener;

use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Service\NotificationService;
 

#[AsDoctrineListener(event: Events::postPersist)]
#[AsDoctrineListener(event: Events::postUpdate)]
class EntityNotificationListener
{
    public function __construct(private NotificationService $notificationService) {}

    public function postUpdate(PostUpdateEventArgs $event): void
    {
        $this->notifyEntityChange($event);
    }

    public function postPersist(PostPersistEventArgs $event): void
    {
        $this->notifyEntityChange($event);
    }

    public function notifyEntityChange(LifecycleEventArgs $event): void
    {
        $entity = $event->getObject();
        $this->notificationService->send($entity);
    }
}
