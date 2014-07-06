Feature: Creating a new Creator
    Scenario: Create a new creator
        When I create a new creator with the name "Sample"
        Then I should see "Created"
        And "workbench/mindofmicah/crudders/tests/tmp/Creators/SampleCreator.php" should match my stub
