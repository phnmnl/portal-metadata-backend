<?php

namespace Tests\Functional\v2;

use Propel\Runtime\Exception\PropelException;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Tests\Functional\BaseTestCase;

class DeploymentTestCase extends BaseTestCase
{
    protected $TEST_USER_ID = "test_user";
    protected $TEST_DEPLOYMENT_NAME = "phn1234566-AWS";
    protected $TEST_DEPLOYMENT_REFERENCE = "TSI1234567890";

    protected $test_user;
    protected $test_deployment_data;

    /**
     * @throws PropelException
     */
    protected function setUp()
    {
        parent::setUp();
        $this->createTestUser();
    }

    /**
     * @throws PropelException
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->deleteTestDeployment();
        $this->deleteTestUser();
    }

    protected function buildTestDeploymentData()
    {
        return array(
            'user' => $this->TEST_USER_ID,
            'name' => $this->TEST_DEPLOYMENT_NAME,
            'reference' => $this->TEST_DEPLOYMENT_REFERENCE,
            'provider' => "AWS",
            'created' => time(),
            'configuration' => $this->settings
        );
    }

    /**
     * @throws PropelException
     */
    protected function createTestUser()
    {
        $data = array(
            'id' => $this->TEST_USER_ID,
            'firstAccess' => time()
        );
        $this->test_user = new \User($data);
        $this->test_user->save();
    }


    protected function deleteTestUser()
    {
        if ($this->test_user)
            ($this->test_user)->delete();
    }

    /**
     * @throws PropelException
     */
    protected function deleteTestDeployment()
    {
        $deployment = \DeploymentQuery::create()->findOneById($this->test_deployment_data->Id);
        if (!$deployment)
            throw new Exception("Illegal state: not found deployment");
        $deployment->delete();
    }

    /**
     *
     * @throws PropelException
     */
    protected function createTestDeployment()
    {
        $deployment = new \Deployment($this->buildTestDeploymentData());
        $deployment->setDeploymentUser($this->test_user);
        $deployment->save();
        $this->test_deployment_data = new \stdClass();
        foreach ($deployment->toArray() as $key => $value)
            $this->test_deployment_data->$key = $value;
    }
}