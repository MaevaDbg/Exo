<?php

namespace Mav\ExoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BreveControllerTest extends WebTestCase
{
    public function testScenario()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/admin/breve/');
        
        $this->assertEquals('Mav\ExoBundle\Controller\BreveController::indexAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur indexaction');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode(), 'la condition est fausse');
        
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());
        
        $this->assertEquals('Mav\ExoBundle\Controller\BreveController::newAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur newaction');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode(), 'la condition est fausse');
        
        $form = $crawler->selectButton('Create')->form(array(
            'mav_exobundle_brevetype[title]'  => 'blablabla',
            'mav_exobundle_brevetype[content]'  => 'blablabla',
            'mav_exobundle_brevetype[status]'  => 1,
            'mav_exobundle_brevetype[photo][name]'  => 'blablabla',
        ));
        
        $client->submit($form);
        
        $crawler = $client->followRedirect();
        
        $this->assertEquals('Mav\ExoBundle\Controller\BreveController::showAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur showaction');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("blablabla")')->count(), 'Missing element td:contains("blablabla")');
        
        $crawler = $client->click($crawler->selectLink('Edit')->link());
        
        $this->assertEquals('Mav\ExoBundle\Controller\BreveController::editAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur editaction');
        
        $form = $crawler->selectButton('Edit')->form(array(
            'mav_exobundle_brevetype[title]'  => 'blublublu',
            'mav_exobundle_brevetype[content]'  => 'blublublu',
            'mav_exobundle_brevetype[status]'  => 1,
            'mav_exobundle_brevetype[photo][name]'  => 'blublublu',
        ));
        
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        
        $crawler = $client->followRedirect();
        
        $this->assertEquals('Mav\ExoBundle\Controller\BreveController::editAction', $client->getRequest()->attributes->get('_controller'),'on ne tombe pas sur editaction');
        
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();
        
        $this->assertNotRegExp('/blublublu/', $client->getResponse()->getContent());
        
    }
}