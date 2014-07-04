<?php
namespace MindOfMicah\Crudders\Commands;

use Illuminate\Console\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Config\Repository as Config;
use MindOfMicah\Classy\Filey;
use MindOfMicah\Classy\Classy;
use MindOfMicah\Classy\Funky;
use Illuminate\Filesystem\Filesystem;

class AddCreatorCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'crudders:c';

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
    protected $file;
    protected $config;

	public function __construct(Filesystem $filesystem, Config $config)
	{
        $this->file = $filesystem;
        $this->config = $config;
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $class_name = $this->argument('creatorName') . 'Creator';
        $file_name = $this->getOptionOrConfigValue('path', 'creator_path') . '/' . $class_name . '.php';

        $this->info('Created');
        $this->file->put($file_name, $this->buildFileContents($class_name));
	}

    private function getOptionOrConfigValue($option, $config_name)
    {
        $path = $this->option('path');
        if ($path) {
            return $path;
        }
        return $this->config->get('crudders::config.'.$config_name);
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
			array('path', 'p', InputOption::VALUE_OPTIONAL, 'Where this creator will be placed.', null),
		);
	}

    /**
     * @return string
     */
    protected function buildFileContents($class_name)
    {
        $filey = new Filey;
        $classy = new Classy($class_name);
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
        return $contents;
    }

}
