<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;

require 'common.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^that "([^"]*)"$/
     */
    public function loadFixture($resource)
    {

        $this->fixtureClass = str_replace(' ', '', ucwords($resource));
    }

    /**
     * @When /^I request "(GET|PUT|POST|DELETE|PATCH) ([^"]*)"$/
     */
    public function iRequest($httpMethod, $resource)
    {
        $options = [];
        if ($this->fixtureClass) {
            $options = ['headers' => [
                'X-MOCK-FIXTURE' => $this->fixtureClass
            ]];
        }
        $client = new \GuzzleHttp\Client();

        try {
            $this->_response = $client->request($httpMethod, 'http://localhost:8000' . $resource, $options);
        } catch (Exception $e) {
            $this->_statusCode = $e->getCode();
        }
    }

    /**
     * @Then I should get:
     */
    public function iShouldGet(PyStringNode $string)
    {
        if (is_object(json_decode($string)) || is_array(json_decode($string))) {
            if (json_decode($string) != json_decode($this->_response->getBody(true))) {
                throw new Exception("Wrong response: " . $this->_response->getBody(true) . "\n");
            }
        } else {
            throw new Exception("Wrong feature format");
        }
    }

    /**
     * @Then /^the response code should be "([^"]*)"$/
     */
    public function theResponseCodeShouldBe($code)
    {
        if ($code != $this->_statusCode) {
            throw new Exception("Wrong status code: " . $this->_statusCode . "\n");
        }
    }
}
