<?php

namespace Mav\ExoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Mav\ExoBundle\Entity\Category;
use Mav\ExoBundle\Entity\Comment;
use Mav\ExoBundle\Entity\Photo;

/**
 * Article
 *
 * @ORM\Entity(repositoryClass="Mav\ExoBundle\Entity\ArticleRepository")
 */
class Article extends Post
{
   
    /**
     * @var string
     *
     * @ORM\Column(name="excerpt", type="text")
     */
    protected $excerpt;
    
    /**
     *
     * @var ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articles", cascade={"persist"})
     */
    protected $categories;
    
    /**
     *
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article", cascade={"persist"}, orphanRemoval=true)
     */
    protected $comments;
    
    /**
     *
     * @var string
     * 
     * @ORM\OneToOne(targetEntity="Photo", cascade={"persist"}, orphanRemoval=true)
     */
    protected $photo;




    public function __construct()
    {  
        parent::__construct();
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

       

    /**
     * Set excerpt
     *
     * @param string $excerpt
     * @return Article
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string 
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }
    
    /**
     * Add categories
     *
     * @param Category $categories
     * @return Article
     */
    public function addCategory(Category $categorie)
    {
        $this->categories[] = $categorie;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param Category $categories
     */
    public function removeCategory(Category $categorie)
    {
        $this->categories->removeElement($categorie);
    }

    /**
     * Get categories
     *
     * @return ArrayCollection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add comments
     *
     * @param Comment $comments
     * @return Article
     */
    public function addComment(Comment $comment)
    {
        $comment->setArticle($this);
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param Comment $comments
     */
    public function removeComment(Comment $comment)
    {
        $comment->setArticle(null);
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return ArrayCollection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set photo
     *
     * @param Photo $photo
     * @return Article
     */
    public function setPhoto(Photo $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return Photo 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
