<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Level
 *
 * @ORM\Table(name="level")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LevelRepository")
 */
class Level
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
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\GroupL")
     *
     * @Assert\NotBlank()
     */
    private $groups;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

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
     * @return Level
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
     * Set studentsNumber
     *
     * @param integer $studentsNumber
     *
     * @return Level
     */
    public function setStudentsNumber($studentsNumber)
    {
        $this->studentsNumber = $studentsNumber;

        return $this;
    }

    /**
     * Get studentsNumber
     *
     * @return int
     */
    public function getStudentsNumber()
    {
        return $this->studentsNumber;
    }

    /**
     * @return ArrayCollection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param ArrayCollection $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @param GroupL $group
     */
    public function addGroup(GroupL $group)
    {
        $this->groups->add($group);
    }

    /**
     * @param GroupL $group
     */
    public function removeGroup(GroupL $group)
    {
        $this->groups->remove($group);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}

