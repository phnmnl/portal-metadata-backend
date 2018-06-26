<?php

namespace Tests\Functional\v2;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class DeploymentCreateTest extends DeploymentTestCase
{
    /**
     *
     */
    public function testCreateDeployment()
    {
        $data = $this->buildTestDeploymentData();
        try {
            $response = $this->runApp('POST',
                '/users/' . $this->TEST_USER_ID . "/deployments", $data);
            $this->logger->debug("Add response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            // store the reference to the created deployment
            $this->test_deployment_data = json_decode((string)$response->getBody())->data;

            // check if the deployment really exists
            $deployment = \DeploymentQuery::create()->findOneById($this->test_deployment_data->Id);
            $this->logger->debug("Created deployment: " . json_encode($deployment));
        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }
}