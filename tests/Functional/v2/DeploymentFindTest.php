<?php

namespace Tests\Functional\v2;

use Propel\Runtime\Exception\PropelException;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class DeploymentFindTest extends DeploymentTestCase
{

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    protected function setUp()
    {
        parent::setUp();
        $this->createTestDeployment();
    }

    /**
     * @throws PropelException
     */
    protected function tearDown()
    {
        $this->deleteTestUser();
        $this->deleteTestDeployment();
    }

    /**
     *
     */
    public function testFindDeploymentsByUser()
    {
        try {
            $response = $this->runApp('GET',
                '/users/' . $this->TEST_USER_ID . "/deployments");
            $this->logger->debug("Find response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            $deployments = json_decode((string)$response->getBody())->data;

            // check if deployments exist
            $this->assertNotEmpty($deployments, "Deployment list empty!");
            $this->assertCount(1, $deployments, "Number of deployments "
                . count($deployments) . " different from the expected 1");

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }


    public function testFindDeploymentByUserAndReference()
    {
        try {
            $response = $this->runApp('GET',
                '/users/' . $this->TEST_USER_ID . "/deployments/" . $this->TEST_DEPLOYMENT_REFERENCE);
            $this->logger->debug("Find response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            $deployment = json_decode((string)$response->getBody())->data;

            // check if deployments exist
            $this->assertNotEmpty($deployment, "Deployment list empty!");
            $this->assertEquals($this->TEST_DEPLOYMENT_REFERENCE, $deployment->Reference);

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }
}