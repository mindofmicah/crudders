<?php
namespace MindOfMicah\Crudders\Interfaces;

use Illuminate\Support\MessageBag;
use Eloquent;

interface CreationHandler
{
    public function onCreationSuccess(Eloquent $model);
    public function onCreationError(MessageBag $errors);
}
