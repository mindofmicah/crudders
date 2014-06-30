<?php
/**
 * 
 **/
require 'vendor/autoload.php';

use MindOfMicah\Crudders\Creator;
use MindOfMicah\Crudders\Interfaces\CreationHandler;
use Illuminate\Support\MessageBag;
use Eloquent;

class SampleCreator extends \MindOfMicah\Crudders\Creator implements CreationHandler
{
    public function create(array $inputs = [], CreationHandler $callable = null){} 
    public function onCreationSuccess(\Eloquent $model){}
    public function onCreationError(MessageBag $errors){}
}

new SampleCreator;
