<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SubjectControllerTest
 * @package Tests\AppBundle\Controller
 */
class SubjectControllerTest extends WebTestCase
{
    /**
     * functional test Route("/matieres)"

     */
    public function testIndex()
    {
        $client = static::createClient();

        echo $client->getKernel()->getEnvironment();

        $crawler = $client->request('GET', '/matieres/', array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Matières', $crawler->filter('.page-header')->text());
    }
    /**
     * functional test Route("/matieres/create)"

     */
    public function testAddSubject()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/matieres/create',array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',));
        $this->assertEquals('AppBundle/Controller/SubjectController::createAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertContains('Créer', $crawler->filter('.page-header')->text());
        $form = $crawler->selectButton('submit')->form();
        $form['subject[name]'] = 'informatique';

        $crawler = $client->submit($form);
        $this->assertContains('Matieres', $crawler->filter('.page-header')->text());

        return $client;
    }
}
