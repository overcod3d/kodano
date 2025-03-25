<?php

namespace App\Notification;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use ReflectionClass;


class EmailNotifier implements NotifierInterface
{
    public function __construct(private MailerInterface $mailer) {}

    public function notify(object $entity): void
    {
        $subject = "Entity changed";

        $class = (new ReflectionClass($entity))->getShortName();
        $id = method_exists($entity, 'getId') ? $entity->getId() : 'n/a';

        $email = (new TemplatedEmail())
            ->to('admin@example.com')
            ->subject($subject)
            ->text('Entity change notification.')
            ->from('noreply@example.com')
            ->htmlTemplate('emails/entity_changed.html.twig')
            ->context([
                'class' => $class,
                'id' => $id
            ]);;

        $this->mailer->send($email);
    }
}
