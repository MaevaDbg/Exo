<?php

namespace Mav\ExoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mav\ExoBundle\Entity\Photo;

/**
 * Breve
 *
 * @ORM\Entity(repositoryClass="Mav\ExoBundle\Entity\BreveRepository")
 */
class Breve extends Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @var string
     * 
     * @ORM\OneToOne(targetEntity="Photo", cascade={"persist"}, orphanRemoval=true)
     */
    protected $photo;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }


}
