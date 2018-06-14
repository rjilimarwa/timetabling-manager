<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * GroupL
 *
 * @ORM\Table(name="group_l")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupLRepository")
 */
class GroupL
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="studentsNumber", type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    private $studentsNumber;



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
     * @return GroupL
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

    /**
     * @return int
     */
    public function getStudentsNumber()
    {
        return $this->studentsNumber;
    }

    /**
     * @param int $studentsNumber
     */
    public function setStudentsNumber($studentsNumber)
    {
        $this->studentsNumber = $studentsNumber;
    }

    public function __toString() {
        return $this->name;
    }

}

