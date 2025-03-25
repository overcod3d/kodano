<?php


namespace App\Tests\Notification;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use App\Notification\EmailNotifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;


class EmailNotifierTest extends TestCase
{
    public function testNotifySendsEmail(): void
    {
        $mailer = $this->createMock(MailerInterface::class);
        $notifier = new EmailNotifier($mailer);

        $product = new Product();
        $product->setName('Test product')->setPrice(99.99);

        $reflection = new \ReflectionClass($product);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($product, 123);

        $mailer->expects($this->once())
            ->method('send')
            ->with($this->callback(function (TemplatedEmail $email) {
                return $email->getSubject() === 'Entity changed'
                    && $email->getTo()[0]->getAddress() === 'admin@example.com'
                    && $email->getFrom()[0]->getAddress() === 'noreply@example.com'
                    && $email->getHtmlTemplate() === 'emails/entity_changed.html.twig'
                    && $email->getContext()['id'] === 123
                    && $email->getContext()['class'] === 'Product';
            }));

        $notifier->notify($product);
    }
}
