<?php

namespace SecureBundle\Repository;

use Doctrine\ORM\EntityRepository;
use SecureBundle\Entity\Account;
use SecureBundle\Entity\Role;
use SecureBundle\Exception\InvalidAccountException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserRepository extends EntityRepository
{
    public function createUser(UserPasswordEncoderInterface $encoder, UserInterface $user)
    {
        $password = $encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

        $accountRepo = $this->_em->getRepository('SecureBundle:Account');

        $account = $accountRepo->findOneBy(array(
            'type' => $user->getAccountType(),
        ));

        if (!$account instanceof Account) {
            throw new InvalidAccountException('Invalid account');
        }

        $role = new Role();
        $role->setRole('ROLE_'.strtoupper($account->getType()));
        $user->addRole($role);

        $user->setAccount($account);

        $this->getEntityManager()->persist($role);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}