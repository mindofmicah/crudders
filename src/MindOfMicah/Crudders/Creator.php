<?php
namespace MindOfMicah\Crudders;

use MindOfMicah\Crudders\Interfaces\CreationHandler;

abstract class Creator
{
    abstract public function create(array $inputs = [], CreationHandler $callable = null);
}
