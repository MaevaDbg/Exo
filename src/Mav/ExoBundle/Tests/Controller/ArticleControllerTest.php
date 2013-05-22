<?php

namespace Mav\ExoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testScenario()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/admin/article/');
        
        $this->assertEquals('Mav\ExoBundle\Controller\ArticleController::indexAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur indexaction');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode(), 'la condition est fausse');
        
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());
        
        $this->assertEquals('Mav\ExoBundle\Controller\ArticleController::newAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur newaction');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode(), 'la condition est fausse');
        
        $form = $crawler->selectButton('Create')->form(array(
            'mav_exobundle_articletype[title]'  => 'blablabla',
            'mav_exobundle_articletype[content]'  => 'blablabla',
            'mav_exobundle_articletype[status]'  => 1,
            'mav_exobundle_articletype[excerpt]'  => 'blablabla',
            'mav_exobundle_articletype[photo][name]'  => 'blablabla',
        ));
        
        $client->submit($form);
        
        $crawler = $client->followRedirect();
        
        $this->assertEquals('Mav\ExoBundle\Controller\ArticleController::showAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur showaction');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("blablabla")')->count(), 'Missing element td:contains("blablabla")');
        
        $crawler = $client->click($crawler->selectLink('Edit')->link());
        
        $this->assertEquals('Mav\ExoBundle\Controller\ArticleController::editAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur editaction');
        
        $form = $crawler->selectButton('Edit')->form(array(
            'mav_exobundle_articletype[title]'  => 'blublublu',
            'mav_exobundle_articletype[content]'  => 'blublublu',
            'mav_exobundle_articletype[status]'  => 1,
            'mav_exobundle_articletype[excerpt]'  => 'blublublu',
            'mav_exobundle_articletype[photo][name]'  => 'blublublu',
        ));
        
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        
        $crawler = $client->followRedirect();
        
        $this->assertEquals('Mav\ExoBundle\Controller\ArticleController::editAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur editaction');
        
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();
        
        $this->assertNotRegExp('/blublublu/', $client->getResponse()->getContent());
        
    }
    
    
}