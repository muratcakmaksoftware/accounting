<?php

namespace App\Console\Commands\Creators;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use function base_path;

class ServiceControllerCreator extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service-controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service Controller';

    protected $type = 'Controller';

    public function handle()
    {
        $this->input->setArgument('name', $this->argument('name').'Controller'); //Test/Test -> Test/TestController
        parent::handle();
    }

    protected function getStub(){
        return base_path('stubs/class-service-controller.stub');
    }

    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Http\\Controllers';
    }

    protected function replaceClass($stub, $name){
        $className = str_replace($this->getNamespace($name).'\\', '', $name); //App\Http\Controllers\Test\TestController -> TestController
        $folderPath = str_replace($className, '', Str::afterLast($name, 'Controllers\\')); //Test\TestController -> Test

        $stub = str_replace('{{ class }}', $className, $stub);
        $stub = str_replace('{{ folder_path }}', $folderPath, $stub);
        return str_replace('{{ class_name }}', str_replace( 'Controller', '', $className), $stub);
    }
}
