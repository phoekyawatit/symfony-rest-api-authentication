<?php
namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\UnitOfWork;
use Knp\DoctrineBehaviors\Contract\Entity\BlameableInterface;
use Knp\DoctrineBehaviors\Contract\Provider\UserProviderInterface;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
class CustomBlameableEventSubscriber implements EventSubscriberInterface
{
    private const DELETED_BY = 'deletedBy';
    private $userProvider,$entityManager;
    public function __construct(UserProviderInterface $userProvider,EntityManagerInterface $entityManager) {
        $this->userProvider = $userProvider;
        $this->entityManager = $entityManager;
    }
    public function preRemove(LifecycleEventArgs $lifecycleEventArgs): void
    {
        $entity = $lifecycleEventArgs->getEntity();
        if (! $entity instanceof BlameableInterface) {
            return;
        }

        $user = $this->userProvider->provideUser();
        if ($user === null) {
            return;
        }

        $oldDeletedBy = $entity->getDeletedBy();
        $entity->setDeletedBy($user);

        $this->getUnitOfWork()->scheduleExtraUpdate($entity, [
            self::DELETED_BY => [$oldDeletedBy, $user],
        ]);
    }

    private function getUnitOfWork(): UnitOfWork
    {
        return $this->entityManager->getUnitOfWork();
    }

    public function getSubscribedEvents(): array
    {
        return [Events::preRemove];
    }
}