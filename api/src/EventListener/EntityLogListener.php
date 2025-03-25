<?php

namespace App\EventListener;

use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use App\Logging\EntityLogger;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Product;
use App\Entity\Category;


#[AsDoctrineListener(event: Events::postPersist)]
#[AsDoctrineListener(event: Events::postUpdate)]
class EntityLogListener
{
    public function __construct(private EntityLogger $logger) {}

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logEntityChange($args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->logEntityChange($args);
    }

    private function logEntityChange(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Product || $entity instanceof Category) {
            $this->logger->log($entity);
        }
    }
}
