<?php


namespace AppBundle\Form\Model;


use Doctrine\Common\Collections\ArrayCollection;

class Export
{

    /** @var ArrayCollection */
    protected $exports;

    public function __construct()
    {
        $this->exports = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getExports()
    {
        return $this->exports;
    }

    /**
     * @param ArrayCollection $exports
     */
    public function setExports($exports)
    {
        $this->exports = new ArrayCollection($exports);
    }

    public function addExport($export)
    {
        $this->exports->add($export);
    }

}