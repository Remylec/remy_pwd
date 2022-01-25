<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface{

    private $em;
    private $pwdEncoder;
    private $security;
    private $pwdGenerator;

    public function __construct(
        EntityManagerInterface $em,
        UserPasswordHasherInterface $pwdEncoder,
        Security $security)
    {
        $this->em = $em;
        $this->pwdEncoder = $pwdEncoder;
        $this->security = $security;

    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['addUser'],
            BeforeEntityUpdatedEvent::class => ['updateUser']
        ];
    }

    public function addUser(BeforeEntityPersistedEvent $event){
        $entity = $event->getEntityInstance();

        if(!($entity instanceof User)){
            return;
        }
        $this->setPassword($entity, true);
    }

    public function updateUser(BeforeEntityUpdatedEvent $event){
        $entity = $event->getEntityInstance();

        if(!($entity instanceof User)){
            return;
        }
        $this->setPassword($entity, false);
    }

    /**
     * @param User $entity
     */
    public function setPassword(User $entity, $add): void
    {
        $pwd = $entity->getPlainPassword();

        if(!empty($pwd)){
            $plainPwd = $pwd;
            $entity->setPassword(
                $this->pwdEncoder->hashPassword($entity,$pwd)
            )
            ->eraseCredentials();

            $this->em->persist($entity);
            $this->em->flush();

        } 
        
    }
}
