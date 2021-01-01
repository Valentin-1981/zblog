<?php
namespace Blog\Entity\Repository;

use Blog\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function login(User $user, $sm)
    {
        $authService = $sm->get('Zend\Authentication\AuthenticationService');
        $adapter = $authService->getAdapter();
        $adapter->setIdentityValue($user->getUsrName());
        $adapter->setCredentialValue($user->getUsrPassword());
        $authResult = $authService->authenticate();
        $identity = null;

        if($authResult->isValid()){
            $identity = $authResult->getIdentity();
            $authService->getStorage()->write($identity);
        }

        return $authResult;
    }
}