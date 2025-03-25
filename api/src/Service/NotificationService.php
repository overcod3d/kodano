<?php

namespace App\Service;


use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class NotificationService
{
    private iterable $notifiers;


    public function __construct(
        #[AutowireIterator(tag: 'app.notifier')]
        iterable $notifiers
    ) {
        $this->notifiers = $notifiers;
    }    

    public function send(object $entity): void
    {
        foreach ($this->notifiers as $notifier) {
            $notifier->notify($entity);
        }
    }
}
