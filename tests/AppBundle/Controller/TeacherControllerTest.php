<?php

namespace Tests\AppBundle\Controller;
use Symfony\Component\HTTPFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class TeacherControllerTest
 *  Tests\AppBundle\Controller
 */

class TeacherControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * functional test Route("/enseignants/create)"

     */
    public function testAddTeacher()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW' => 'sihem',
        ]);

        $crawler =$client->request('GET', '/enseignants/create');

        static::assertEquals(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );



        $form = $crawler->selectButton('Créer')->form();
        $form['teacher[firstName]'] = 'John Doe';
        $form['teacher[lastName]'] = 'Plat de pâtes';
        $form['teacher[cin]'] = 13405998;
        $form['teacher[tel]'] = 95359107;
        $form['teacher[address]'] = 'djerba';

        $crawler = $client->followRedirect(); // Attention à bien récupérer le crawler mis à jour

        $this->assertContains('Enseignants', $crawler->filter('.page-header')->text());

        return $client;

    }
}
