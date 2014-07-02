<?php
namespace MindOfMicah\Crudders\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use MindOfMicah\Classy\Filey;
use MindOfMicah\Classy\Classy;
use MindOfMicah\Classy\Funky;

class AddCreatorCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:name';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
        $this->info('Created');

        $filey=  new Filey;
        $classy =new Classy('SampleCreator');
        $classy->willExtend('MindOfMicah\Crudders\Creator'); 
        $classy->willImplement('MindOfMicah\Crudders\Interfaces\CreationHandler');
    
          $f = new Funky('create');
          $f->Param('array $inputs = []');
          $f->Param('\MindOfMicah\Crudders\Interfaces\CreationHandler $callable = null');

        $classy->addFunction($f);
        $f = new Funky('onCreationSuccess');
        $f->param('Eloquent $model');
        $classy->addFunction($f);
        $f = new Funky('onCreationError');
        $f->param('Illuminate\Support\MessageBag $errors');
        $classy->addFunction($f);
        $filey->append($classy);


        $contents = $filey->render() . "\n";;        
        file_put_contents('tests/tmp/SampleCreator.php', $contents);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('creatorName', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
