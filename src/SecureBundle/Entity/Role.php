<?php

namespace SecureBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class Role
{
    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $role
     */
    private $role;
    /**
     * @var UserInterface $user
     */
    private $user;
    /**
     * @return mixed
     */
    public function getRole() : string
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole(string $role)
    {
        $this->role = $role;
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return UserInterface
     */
    public function getUser() : UserInterface
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }


}