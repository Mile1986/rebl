<?php

namespace SecureBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, \Serializable
{
    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $username
     */
    private $username;
    /**
     * @var string $password
     */
    private $password;
    /**
     * @var string $plainPassword
     */
    private $plainPassword;
    /**
     * @var array $roles
     */
    private $roles;
    /**
     * @var Account $accounts
     */
    private $account;
    /**
     * @var bool $trial
     */
    private $trial = true;
    /**
     * @return int
     */
    public function getId()
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

    public function addRole(string $role)
    {

    }
    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }
    /**
     * @return array
     */
    public function getRoles() : array
    {
        return $this->roles;
    }
    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @return string
     */
    public function getSalt() : string
    {
        return password_hash(sha1(rand(0, 999999)), PASSWORD_BCRYPT);
    }
    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }
    /**
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }
    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }
    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }
    /**
     * @param Account $account
     */
    public function setAccount(Account $account)
    {
        $this->account = $account;
    }
    /**
     * @return bool
     */
    public function isTrial(): bool
    {
        return $this->trial;
    }
    /**
     * @param bool $trial
     */
    public function setTrial(bool $trial)
    {
        $this->trial = $trial;
    }
}