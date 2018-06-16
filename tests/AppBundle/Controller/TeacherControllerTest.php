<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeacherControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        echo $client->getKernel()->getEnvironment();

        $crawler = $client->request('GET', '/enseignants/', array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Enseignants', $crawler->filter('.page-header')->text());
    }

    public function testCreateTeacher()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/enseignants/create',array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',));
        $this->assertEquals('AppBundle\Controller\TeacherController::createAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertContains('Créer', $crawler->filter('.page-header')->text());
        $form = $crawler->selectButton('submit')->form();
        $form['teacher[firstName]'] = 'marwa';
        $form['teacher[lastName]'] = 'rjili';
        $form['teacher[cin]'] = '13405998';
        $form['teacher[tel]'] = '95395107';
        $form['teacher[email]'] = 'rjilimarwadjerba@gmail.com';
        $form['teacher[address]'] = 'Djerba';
        $crawler = $client->submit($form);
        $this->assertContains('Enseignants', $crawler->filter('.page-header')->text());

        return $client;
    }





}
