<?php

namespace spec\MindOfMicah\Crudders\Commands;

use Illuminate\Config\Repository as Config;
use MindOfMicah\Classy\Classy;
use MindOfMicah\Classy\Filey;
use MindOfMicah\Classy\Funky;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Filesystem\Filesystem;

class AddCreatorCommandSpec extends ObjectBehavior
{
    function let(Filesystem $f, Config $config)
    {
        $this->beAnInstanceOf('spec\MindofMicah\Crudders\Commands\MyMock');
        $this->beConstructedWith($f, $config);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\Crudders\Commands\AddCreatorCommand');
    }

    function it_should_generate_new_creator(Filesystem $file, Config $config)
    {
        $config->get('creator_path')->willReturn('app');
        $file->put('app/SampleCreator.php', 'contents')->shouldBeCalledTimes(1);

        $this->beConstructedWith($file, $config);

        $this->fire()->shouldBe(null);
    }
}

class MyMock extends \MindOfMicah\Crudders\Commands\AddCreatorCommand
{
    public function info($str)
    {
        return $str;
    }

    protected function buildFileContents($class_name)
    {
        return 'contents';
    }


    public function option($option = null)
    {
        return null;
    }

    public function argument($key = null)
    {
        return 'Sample';
    }
}