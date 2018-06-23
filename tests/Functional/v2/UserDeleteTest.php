<?php

namespace Tests\Functional;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class UserDeleteTest extends BaseTestCase
{
    private $TEST_USER_ID = "test_user";

    protected function setUp()
    {
        parent::setUp();
        $user = array(
            'id' => $this->TEST_USER_ID,
            'firstAccess' => time()
        );
        try {
            $response = $this->runApp('POST', '/statistics/users', $user);
            $this->logger->debug("Add response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());
        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }

    public function testDeleteUser()
    {
        try {
            $response = $this->runApp('DELETE', '/statistics/users/' . $this->TEST_USER_ID);
            $this->logger->debug("Delete response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());
        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }
}