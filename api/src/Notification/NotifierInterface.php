<?php

namespace App\Notification;

interface NotifierInterface
{
    public function notify(object $entity): void;
}
