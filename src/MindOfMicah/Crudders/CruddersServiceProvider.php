<?php
namespace MindOfMicah\Crudders;
use Illuminate\Support\ServiceProvider;
use MindOfMicah\Crudders\Commands\AddCreatorCommand;

class CruddersServiceProvider  extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->package('mindofmicah/crudders');
    }

    public function register()
    {
        $this->registerCreator();
    }

    private function registerCreator()
    {
        $this->app['crudders.create'] = $this->app->share(function ($app) {
            return $this->app->make('MindOfMicah\Crudders\Commands\AddCreatorCommand');
        });

        $this->commands('crudders.create');
    }


} 