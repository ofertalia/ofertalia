<?php

namespace AppBundle\Entity;

/**
 * Store
 */
class Company
{
    const STATE_PENDING = 1;
    const STATE_VALID = 2;
    const STATE_INVALID = 3;

    private $id;
    private $name;
    private $state;

    // Tiendeo do not use this info.
    private $description;

    // Admin user
    private $user;




    private $stores;
    private $category;
    private $logo;



    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
}

