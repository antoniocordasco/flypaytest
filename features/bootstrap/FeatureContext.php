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
     * @Given /^there are three items in the menu$/
     */
    public function thereAreThreeItemsInTheMenu()
    {
        $this->fixtureClass = 'ThereAreThreeItemsInTheMenu';
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

        $this->_response = $client->request($httpMethod, 'http://localhost:8000' . $resource, $options);

    }

    /**
     * @Then I should get:
     */
    public function iShouldGet2(PyStringNode $string)
    {
        if (json_decode($string) != json_decode($this->_response->getBody(true))) {
            throw new Exception("Wrong response: " . $this->_response->getBody(true) . "\n");
        }
    }
}
