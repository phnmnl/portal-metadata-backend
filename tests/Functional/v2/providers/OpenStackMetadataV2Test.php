<?php

namespace Tests\Functional\v2\providers;

use Propel\Runtime\Exception\PropelException;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Tests\Functional\BaseTestCase;

class OpenStackMetadataV2Test extends OpenStackMetadataTestCase
{

    public function getCredentials()
    {
        return array(
            "OS_AUTH_URL" => getenv("OS_AUTH_URL"),
            "OS_USERNAME" => getenv("OS_USERNAME"),
            "OS_PASSWORD" => getenv("OS_PASSWORD"),
            "OS_TENANT_ID" => getenv("OS_TENANT_ID"),
        );
    }

    public function testAuthenticate()
    {
        $data = $this->getCredentials();
        try {
            $response = $this->runApp('POST', '/providers/openstack/authenticate', $data);
            $this->assertEquals(200, $response->getStatusCode());

            // check not empty response
            $this->assertNotEmpty($response->getBody(), "Authentication response seems to be empty");

            // decode response
            $data = json_decode($response->getBody(), true);

            // check not empty data
            $this->assertNotEmpty($data, "Authentication results seem to be empty");

            // check if data object contains the "data" field
            $this->assertArrayHasKey("data", $data, "Data object doesn't contain the property 'data'");

            // check if the response contains a token
            $data = $data['data'];
            $this->assertArrayHasKey($this->AUTH_TOKEN_FIELD, $data, "Token not found");
            $this->logger->debug("TOKEN field: " . $data[$this->AUTH_TOKEN_FIELD]);

            // check if the response contains a valid catalog
            $this->assertArrayHasKey("access", $data, "access property not found");
            $this->assertArrayHasKey("serviceCatalog", $data["access"], "ServiceCatalog not found");

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }



}