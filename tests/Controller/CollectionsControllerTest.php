<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CollectionsControllerTest extends WebTestCase
{

    public function testCollections()
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/collection/collections');
        $responseContent = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonFile(
            __DIR__ . '/responses/CollectionsControllerTest_testCollections.json',
            $responseContent
        );

    }
}
