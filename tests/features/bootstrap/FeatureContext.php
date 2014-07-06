<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;


use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../../../vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    protected $tester;

    /**
     * @beforeSuite
     */
    public static function bootstrapLaravel()
    {
        require __DIR__ . '/../../../../../../vendor/autoload.php';
        require __DIR__ . '/../../../../../../bootstrap/start.php';
    }

    /**
     *@afterSuite
     */
    public static function tearDown()
    {
        \Illuminate\Support\Facades\File::deleteDirectory(base_path('workbench/mindofmicah/crudders/tests/tmp'), true);
    }

    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @When /^I create a new creator with the name "([^"]*)"$/
     */
    public function iCreateANewCreatorWithTheName($creator_name)
    {
        $this->tester = new CommandTester(App::make('MindOfMicah\Crudders\Commands\AddCreatorCommand'));
        $this->tester->execute([
            'creatorName' => $creator_name,
            '--path' => __DIR__ . '/../../tmp'
        ]);
    }

    /**
     * @Then /^I should see "([^"]*)"$/
     */
    public function iShouldSee($output)
    {
        assertContains($output, $this->tester->getDisplay());
    }

    /**
     * @Given /^"([^"]*)" should match my stub$/
     */
    public function shouldMatchMyStub($arg1)
    {
        $stub = pathinfo($arg1)['filename'];
        assertEquals(
            //file_get_contents(trim(__DIR__ . "/../../../stubs/{$stub}.txt")),
            file_get_contents(trim(__DIR__ . "/../../../stubs/creator.txt")),
            file_get_contents(trim(base_path($arg1)))
        );
    }

}
