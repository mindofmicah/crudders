<?php
use MindOfMicah\Crudders\Creator;
use MindOfMicah\Crudders\Interfaces\CreationHandler;
use Eloquent;
use Illuminate\Support\MessageBag;

class SampleCreator extends Creator implements CreationHandler
{
    public function create(array $inputs = [], CreationHandler $callable = null)
    {
    }
    public function onCreationSuccess(Eloquent $model)
    {
    }
    public function onCreationError(MessageBag $errors)
    {
    }
}
