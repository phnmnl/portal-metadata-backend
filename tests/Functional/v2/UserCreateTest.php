<?php

namespace Tests\Functional;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class UserCreateTest extends BaseTestCase
{
    private $TEST_USER_ID = "test_user";

    protected function tearDown()
    {
        parent::tearDown();
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

    public function testCreateUser()
    {
        $user = array(
            'id' => $this->TEST_USER_ID,
            'firstAccess' => time()
        );
        try {
            $response = $this->runApp('POST', '/statistics/users', $user);
            $this->logger->debug("Add response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            $user = \UserQuery::create()->findOneById($this->TEST_USER_ID);
            $this->assertEquals(1, $user->getNumberOfAccesses(),
                "Number of accesses is not correct: it should be 1 after a user creation !!!");

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }
}