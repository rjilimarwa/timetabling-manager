<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RoomControllerTest
 * @package Tests\AppBundle\Controller
 */

class RoomControllerTest extends WebTestCase
{
    /**
     * functional test Route("/classes")

     */
    public function testIndex()
    {
        $client = static::createClient();

        echo $client->getKernel()->getEnvironment();

        $crawler = $client->request('GET', '/classes/', array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Classes', $crawler->filter('.page-header')->text());
    }
    /**
     * functional test Route("/classes/create")

     */
    public function testAddRoom()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/classes/create',array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',));
        $this->assertEquals('AppBundle/Controller/RoomController::createAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertContains('Créer', $crawler->filter('.page-header')->text());
        $form = $crawler->selectButton('submit')->form();
        $form['room[name]'] = 'Cl1';
        $form['room[capacity]'] = 25;

        $this->assertContains('Classes', $crawler->filter('.page-header')->text());

        return $client;
    }
}
