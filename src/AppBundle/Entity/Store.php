<?php

namespace AppBundle\Entity;

/**
 * Store
 */
class Store
{
    /**
     * @var int
     */
    private $id;
    private $company;
    private $pictures;

    /**
     * @var string
     */
    private $name;


    private $offers;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Store
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

