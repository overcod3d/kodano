<?php

namespace App\Logging;

use Psr\Log\LoggerInterface;
use ReflectionClass;


class EntityLogger
{
    public function __construct(private LoggerInterface $logger) {}

    public function log(object $entity): void
    {
        $this->logger->info('test');
        
        $class = (new ReflectionClass($entity))->getShortName();
        $id = method_exists($entity, 'getId') ? $entity->getId() : 'n/a';

        $this->logger->info(sprintf('Entity saved: %s (ID: %s)', $class, $id), [
            'entity' => $entity,
        ]);
    }
}
