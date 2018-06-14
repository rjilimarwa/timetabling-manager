<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivityRepository")
 */
class Activity
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     *
     * @Assert\NotBlank()
     */
    private $duration;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPerWeek", type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    private $nbPerWeek;

    /** @ORM\OneToOne(targetEntity="AppBundle\Entity\Teacher")
     *
     * @Assert\NotBlank()
     */
    private $teacher;

    /** @ORM\ManyToMany(targetEntity="AppBundle\Entity\GroupL")
     *
     * @Assert\NotBlank()
     */
    private $groups;

    /** @ORM\ManyToMany(targetEntity="AppBundle\Entity\Level")
     *
     * @Assert\NotBlank()
     */
    private $levels;

    /** @ORM\OneToOne(targetEntity="AppBundle\Entity\Subject")
     *
     * @Assert\NotBlank()
     */
    private $subject;

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
     * @return Activity
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
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $code
     * @return Activity
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }



    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Activity
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set nbPerWeek
     *
     * @param integer $nbPerWeek
     *
     * @return Activity
     */
    public function setNbPerWeek($nbPerWeek)
    {
        $this->nbPerWeek = $nbPerWeek;

        return $this;
    }

    /**
     * Get nbPerWeek
     *
     * @return int
     */
    public function getNbPerWeek()
    {
        return $this->nbPerWeek;
    }

    /**
     * @return mixed
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param mixed $teacher
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return mixed
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * @param mixed $levels
     */
    public function setLevels($levels)
    {
        $this->levels = $levels;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

}

