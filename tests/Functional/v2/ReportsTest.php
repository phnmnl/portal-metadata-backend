<?php

namespace Tests\Functional;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class ReportsTest extends BaseTestCase
{
    public function testJenkinsReport()
    {
        try {
            $response = $this->runApp('GET', '/jenkins-report');
            $this->logger->debug("Response body: " . $response->getBody());
            $this->assertEquals(200, $response->getStatusCode());
        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }

    public function testGoogleKey()
    {
        try {
            $response = $this->runApp('GET', '/google-key');
            $this->logger->debug("Response body: " . $response->getBody());
            $this->assertEquals(200, $response->getStatusCode());
        } catch (MethodNotAllowedException $e) {
            print_r($e->getTrace());
        } catch (NotFoundException $e) {
            print_r($e->getTrace());
        }
    }
}