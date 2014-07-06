<?php
namespace MindOfMicah\Crudders;

use MindOfMicah\Crudders\Interfaces\CreationHandler;
use MindOfMicah\FormValidation\Validator;

abstract class Creator
{
    protected $validator;

    public function __construct(FormValidation $validator)
    {
        $this->validator = $validator;
    }

    abstract public function create(array $inputs = [], CreationHandler $callable = null);
}
