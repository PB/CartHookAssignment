<?php

namespace Test\Unit\Services\JsonPlaceHolderClient;

use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;

class JsonPlaceHolderClientTest extends TestCase
{
    public function setUpGuzzelMockClient()
    {
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], \json_encode(['test' => 'test'], JSON_THROW_ON_ERROR)),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);

        return new Client(['handler' => $handlerStack]);
    }

    public function getJsonPlaceHolderClient()
    {
        return new JsonPlaceHolderClient($this->setUpGuzzelMockClient());
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(JsonPlaceHolderClient::class, $this->getJsonPlaceHolderClient());
    }

    public function testGetUsers()
    {
        $users = $this->getJsonPlaceHolderClient()->getUsers();
        $this->assertArrayHasKey('test', $users);
    }

    public function testGetPosts()
    {
        $users = $this->getJsonPlaceHolderClient()->getPosts();
        $this->assertArrayHasKey('test', $users);
    }

    public function testGetComments()
    {
        $users = $this->getJsonPlaceHolderClient()->getComments();
        $this->assertArrayHasKey('test', $users);
    }

    public function testGetUserPosts()
    {
        $users = $this->getJsonPlaceHolderClient()->getUserPosts(1);
        $this->assertArrayHasKey('test', $users);
    }

    public function testGetPostComments()
    {
        $users = $this->getJsonPlaceHolderClient()->getPostComments(1);
        $this->assertArrayHasKey('test', $users);
    }
}
