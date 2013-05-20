<?php

namespace Mav\ExoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Mav\ExoBundle\Entity\Article;
use Mav\ExoBundle\Entity\Breve;
use Mav\ExoBundle\Entity\Category;
use Mav\ExoBundle\Entity\Comment;
use Mav\ExoBundle\Entity\Photo;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        //Ajouter des catégories
        for ($i = 0; $i < 10; ++$i) {
            
            $categ = $this->newCateg();
            $manager->persist($categ);
            
        }
        $manager->flush();
        
        
        //Ajouter des articles
        for ($i = 0; $i < 50; ++$i) {
            
            $article = $this->newArticle($manager);
            $manager->persist($article);
            
        }
        
        //Ajouter des Brèves
        for ($i = 0; $i < 50; ++$i) {
            
            $breve = $this->newBreve();
            $manager->persist($breve);
            
        }
        
        $manager->flush();
        
    }
    
    public function newArticle(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        
        $article = new Article();
        $article->setTitle($faker->sentence(3));
        $article->setContent($faker->paragraph(10));
        $article->setExcerpt($faker->text);
        $article->setStatus(true);
        
        $categ = $manager->getRepository('MavExoBundle:Category')->findOneRandom();
        $article->addCategory($categ);
        
        
        $photo = $this->newPhoto();
        $article->setPhoto($photo);
        
        for($i = 0; $i<4; ++$i){
            $comment = $this->newComment();
            $article->addComment($comment);
        }
        
        return $article;
        
    }
    
    public function newPhoto()
    {
        $faker = \Faker\Factory::create();
        
        $photo = new Photo();
        $photo->setName($faker->word);
        
        return $photo;
    }
    
    public function newBreve()
    {
        $faker = \Faker\Factory::create();
        
        $breve = new Breve();
        $breve->setTitle($faker->sentence(3));
        $breve->setContent($faker->paragraph(10));
        $breve->setStatus(true);
        
        $photo = $this->newPhoto();
        $breve->setPhoto($photo);
        
        return $breve;
    }
    
    public function newCateg()
    {
        $faker = \Faker\Factory::create();
        
        $categ = new Category();
        $categ->setName($faker->word);
        
        return $categ;
    }
    
    
    public function newComment()
    {
        $faker = \Faker\Factory::create();
        
        $comment = new Comment();
        $comment->setAuthor($faker->name);
        $comment->setContent($faker->text);
        $comment->setStatus(true);
        
        return $comment;
    }
    
    
}

