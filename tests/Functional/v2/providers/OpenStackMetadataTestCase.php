<?php

namespace Tests\Functional\v2\providers;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Tests\Functional\BaseTestCase;

abstract class OpenStackMetadataTestCase extends BaseTestCase
{

    protected $AUTH_TOKEN_FIELD = "authToken";

    protected $authenticationToken = null;

    public abstract function getCredentials();


    public function testAuthenticateFailure()
    {
        try {

            $data = array("OS_TENANT_ID" => "PhenoMeNal");
            $response = $this->runApp('POST', '/providers/openstack/authenticate', $data);
            $this->assertEquals(401, $response->getStatusCode());

            // check not empty response
            $this->assertNotEmpty($response->getBody(), "Authentication response seems to be empty");

            // decode response
            $data = json_decode($response->getBody(), true);

            // check not empty data
            $this->assertNotEmpty($data, "Authentication results seem to be empty");

            // check if data object contains the "data" field
            $this->assertArrayHasKey("error", $data, "Error object doesn't contain the property 'error'");

            // check if the response contains a token
            $data = $data['error'];
            $this->assertArrayHasKey("code", $data, "Error code not defined");
            $this->assertArrayHasKey("message", $data, "Error message not defined");
            print_r($data);

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }


    public function testAuthenticateFailureWithInvalidCredentials()
    {
        try {

            $credentials = $this->getCredentials();
            $credentials["OS_USERNAME"] .= "x";
            $response = $this->runApp('POST', '/providers/openstack/authenticate', $credentials);
            $this->assertEquals(401, $response->getStatusCode());

            // check not empty response
            $this->assertNotEmpty($response->getBody(), "Authentication response seems to be empty");

            // decode response
            $data = json_decode($response->getBody(), true);

            // check not empty data
            $this->assertNotEmpty($data, "Authentication results seem to be empty");

            // check if data object contains the "data" field
            $this->assertArrayHasKey("error", $data, "Error object doesn't contain the property 'error'");

            // check if the response contains a token
            $data = $data['error'];
            $this->assertArrayHasKey("code", $data, "Error code not defined");
            $this->assertArrayHasKey("message", $data, "Error message not defined");
            print_r($data);

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }


    /**
     *
     */
    public function testListFlavors()
    {
        try {
            $data = $this->getCredentials();
            $response = $this->runApp('POST', '/providers/openstack/flavors', $data);
            $this->logger->debug("GET Flavours Response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            $data = json_decode($response->getBody(), true)["data"];
            $this->logger->debug("Decoded RESPONSE: " . json_encode($data));

            // Check not empty
            $this->assertNotEmpty($data, "Flavors array is empty!!!");

            // Check if it contains the "networks" key
            $this->assertArrayHasKey("flavors", $data, "Flavour array doesn't contain the key 'flavor'");

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }


    /**
     *
     */
    public function testListExternalNetworks()
    {
        try {

            $data = $this->getCredentials();
            $response = $this->runApp('POST', '/providers/openstack/external-networks', $data);
            $this->logger->debug("GET Flavours Response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            $data = json_decode($response->getBody(), true)["data"];
            $this->logger->debug("Decoded RESPONSE: " . json_encode($data));

            // Check not empty
            $this->assertNotEmpty($data, "Flavours array is empty!!!");

            // Check if it contains the "networks" key
            $this->assertArrayHasKey("networks", $data, "Networks array doesn't contain the key 'networks'");
            print_r($data);

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }


    /**
     *
     */
    public function testListFloatingIpPools()
    {
        try {

            $data = $this->getCredentials();
            $response = $this->runApp('POST', '/providers/openstack/ip-pools', $data);
            $this->logger->debug("GET Flavours Response: " . (string)$response->getBody());
            $this->assertEquals(200, $response->getStatusCode());

            $data = json_decode($response->getBody(), true)["data"];
            $this->logger->debug("Decoded RESPONSE: " . json_encode($data));

            // Check not empty
            $this->assertNotEmpty($data, "Flavours array is empty!!!");

            // Check if it contains the "floating_ip_pools" key
            $this->assertArrayHasKey("floating_ip_pools", $data, "Networks array doesn't contain the key 'networks'");
            print_r($data);

        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }

}