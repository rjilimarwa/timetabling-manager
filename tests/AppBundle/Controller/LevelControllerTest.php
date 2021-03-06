<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LevelControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        echo $client->getKernel()->getEnvironment();

        $crawler = $client->request('GET', '/niveaux/', array(), array(), array(
            'PHP_AUTH_USER' => 'sihem',
            'PHP_AUTH_PW'   => 'sihem',
        ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Niveaux', $crawler->filter('.page-header')->text());
    }
}
