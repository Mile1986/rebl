<?php

namespace SecureBundle\Entity;

class Account
{
    /**
     * @var int $id
     */
    private $id;
    /**
     * @var string $type
     */
    private $type;
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}