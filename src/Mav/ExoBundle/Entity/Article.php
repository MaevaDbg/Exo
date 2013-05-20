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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

        /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
    public function addCategory(Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param Category $categories
     */
    public function removeCategory(Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
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
    public function addComment(Comment $comments)
    {
        $comments->setArticle($this);
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param Comment $comments
     */
    public function removeComment(Comment $comments)
    {
        $comments->setArticle(null);
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
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
