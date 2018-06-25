<?php

namespace Tests\Functional\v2;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class DeploymentUpdateTest extends DeploymentTestCase
{
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    protected function setUp()
    {
        parent::setUp();
        $this->createTestDeployment();
    }

    public function testUpdateCreatedDeployment()
    {
        return $this->_testUpdateTimeDeployment("created");
    }

    public function testUpdateDeployedDeployment()
    {
        return $this->_testUpdateTimeDeployment("deployed");
    }


    public function testUpdateDestroyedDeployment()
    {
        return $this->_testUpdateTimeDeployment("destroyed");
    }

    public function testUpdateFaileddDeployment()
    {
        return $this->_testUpdateTimeDeployment("failed");
    }

    /**
     *
     */
    private function _testUpdateTimeDeployment($timeType)
    {
        $reference = $this->test_deployment_data->Reference;

        $currentTime = $this->test_deployment_data->{ucfirst($timeType)};
        $expectedTime = time();

        $data = array($timeType => $expectedTime);

        try {
            $response = $this->runApp('PUT',
                '/users/' . $this->TEST_USER_ID . "/deployments/" . $reference, $data);
            $this->logger->debug("Update response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            // store the reference to the created deployment
            $this->test_deployment_data = json_decode((string)$response->getBody())->data;

            // check if the deployment really exists
            $deployment = \DeploymentQuery::create()->findOneById($this->test_deployment_data->Id);
            $actualTime = $deployment->{'get' . ucfirst($timeType)}()->getTimestamp();
            $this->logger->debug("Updated '$timeType' of deployment '$reference': " . $actualTime);

            // check time
            $this->assertNotEquals($currentTime, $actualTime, "Time not updated!");
            $this->assertEquals($expectedTime, $actualTime,
                "Actual time '$actualTime' not equal to the expected '$expectedTime'");

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }
}