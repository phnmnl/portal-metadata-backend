<?php

namespace Tests\Functional;

class InstitutionControllerTest extends BaseTestCase
{
    /**
     * Test that the index route with optional name argument returns a rendered greeting
     */
    public function testGetInstitution()
    {
        $response = $this->runApp('GET', '/api/v1/institution/British Library');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPostInstitution()
    {
        $response = $this->runApp('POST', '/api/v1/institution', ['test']);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPutInstitution()
    {
        $response = $this->runApp('PUT', '/api/v1/institution');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteInstitution()
    {
        $response = $this->runApp('DELETE', '/api/v1/institution/British Library');

        $this->assertEquals(200, $response->getStatusCode());
    }

}