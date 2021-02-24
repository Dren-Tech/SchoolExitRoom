<?php

namespace App\EventSubscriber;

use App\Entity\Student;
use App\Service\Entity\StudentService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Validator\Constraints\Date;

class LoginEventSubscriber implements EventSubscriberInterface
{
    private StudentService $studentService;

    /**
     * LoginEventSubscriber constructor.
     * @param StudentService $studentService
     */
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $this->saveLoginTimeOfStudent($event->getAuthenticationToken()->getUser());
    }

    public static function getSubscribedEvents()
    {
        return [
            'security.interactive_login' => 'onSecurityInteractiveLogin',
        ];
    }

    private function saveLoginTimeOfStudent(UserInterface $user): void
    {
        if($user instanceof Student) {
            $user->setLastLoginTime(new \DateTime());
            $this->studentService->saveStudent($user);
        }
    }
}
