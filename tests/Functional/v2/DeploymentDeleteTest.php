<?php

namespace Tests\Functional\v2;

use Propel\Runtime\Exception\PropelException;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class DeploymentDeleteTest extends DeploymentTestCase
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
    }

    /**
     *
     */
    public function testDeleteDeployment()
    {
        $reference = $this->test_deployment_data->Reference;
        try {
            $response = $this->runApp('DELETE',
                '/users/' . $this->TEST_USER_ID . "/deployments/" . $reference);
            $this->logger->debug("Delete response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            // check if the deployment has been deleted exists
            $deployment = \DeploymentQuery::create()->findOneById($this->test_deployment_data->Id);
            print_r($deployment);
            $this->assertEmpty($deployment, "Deployment $reference has not been deleted!");

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }
}