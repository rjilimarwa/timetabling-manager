<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class GroupControllerTest
 * @package Tests\AppBundle\Controller
 */

class GroupControllerTest extends WebTestCase
{
    /**
     * functional test Route("/groupes)"

     */
    public function testIndex()
    {
        $client = static::createClient();

        echo $client->getKernel()->getEnvironment();

        $crawler = $client->request('GET', '/groupes/', array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Groupes', $crawler->filter('.page-header')->text());
    }

    /**
     * functional test Route("/groupes/create)"

     */
    public function testAddGroup()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/groupes/create',array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',));
        $this->assertEquals('AppBundle/Controller/GroupController::createAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertContains('Créer', $crawler->filter('.page-header')->text());
        $form = $crawler->selectButton('submit')->form();
        $form['teacher[name]'] = 'gl3';
        $form['teacher[studentsNumber]'] = 25;

        $crawler = $client->submit($form);
        $this->assertContains('Groupes', $crawler->filter('.page-header')->text());

        return $client;
    }
}
