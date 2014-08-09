<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\WebApiExtension\Context\WebApiContext;

use GuzzleHttp\Client;

/**
 * Behat context class.
 */
class FeatureContext extends WebApiContext implements SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        parent::setClient(new Client(['base_url' => 'http://chooshop.dev/app_dev.php/api/1/']));
        $this->addHeader('Content-Type', 'application/json');
    }

    /**
     * @Given I use the token :arg1
     */
    public function iUseTheToken($token)
    {
        $this->addHeader('Token', $token);
    }
}
