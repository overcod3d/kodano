<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\NotificationService;
use App\Notification\NotifierInterface;
use stdClass;

class NotificationServiceTest extends TestCase
{
    public function testSendCallsNotifyOnAllNotifiers(): void
    {
        $entity = new stdClass();
    
        $notifiers = [
            $this->createMock(NotifierInterface::class),
            $this->createMock(NotifierInterface::class),
        ];
    
        foreach ($notifiers as $notifier) {
            $notifier->expects($this->once())
                ->method('notify')
                ->with($entity);
        }
    
        $service = new NotificationService($notifiers);
        $service->send($entity);
    }    
}
