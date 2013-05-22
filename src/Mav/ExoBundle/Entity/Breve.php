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
     *
     * @var Photo
     * 
     * @ORM\OneToOne(targetEntity="Photo", cascade={"persist"}, orphanRemoval=true)
     */
    protected $photo;


    /**
     * 
     * @return Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    
    /**
     * 
     * @param Photo $photo
     * @return Breve
     */
    public function setPhoto(Photo $photo = null)
    {
        $this->photo = $photo;
        return $this;
    }


}
