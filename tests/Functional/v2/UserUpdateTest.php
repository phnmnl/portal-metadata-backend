<?php

namespace Tests\Functional;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class UserUpdateTest extends BaseTestCase
{
    private $TEST_USER_ID = "test_user";

    protected function setUp()
    {
        parent::setUp();
        $user = array(
            'id' => $this->TEST_USER_ID,
            'firstAccess' => time() - 1 // "-1" to simulate a previous access
        );
        try {
            $response = $this->runApp('POST', '/users', $user);
            $this->logger->debug("Add response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());
        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }

    protected function tearDown()
    {
        parent::tearDown();
        try {
            $response = $this->runApp('DELETE', '/users/' . $this->TEST_USER_ID);
            $this->logger->debug("Delete response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());
        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }


    public function testUpdateUser()
    {
        $data = array(
            'lastAccess' => time()
        );
        try {
            // get the number of access before the update
            $user = \UserQuery::create()->findOneById($this->TEST_USER_ID);
            $numberOfAccessesBefore = $user->getNumberOfAccesses();
            $this->logger->debug("Number of accesses before: " . $numberOfAccessesBefore
                . " (last access: " . $user->getLastAccess()->getTimestamp() . ")");

            // run the update
            $response = $this->runApp('PUT',
                "/users/$this->TEST_USER_ID", $data);
            $this->logger->debug("Add response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            // get the number of accesses after the update
            $user = \UserQuery::create()->findOneById($this->TEST_USER_ID);
            $numberOfAccessesAfter = $user->getNumberOfAccesses();
            $this->logger->debug("Number of accesses after: " . $numberOfAccessesAfter);

            $this->logger->debug("Number of accesses after: " . $numberOfAccessesAfter
                . " (last access: " . $user->getLastAccess()->getTimestamp() . ")");

            // check if the number of accesses has been updated
            $this->assertTrue($numberOfAccessesAfter === ($numberOfAccessesBefore + 1),
                "Number of accesses has not been incremented by one !!!");

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }
}