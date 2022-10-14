<?php

namespace App\Console\Commands\Creators;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use function base_path;

class ServiceCreator extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service';

    protected $type = 'Service';

    public function handle()
    {
        $this->input->setArgument('name', $this->argument('name').'Service');
        parent::handle();
    }

    protected function getStub(){
        return base_path('stubs/class-service.stub');
    }

    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Services';
    }

    protected function replaceClass($stub, $name){
        $className = str_replace($this->getNamespace($name).'\\', '', $name);
        $folderPath = str_replace($className, '', Str::afterLast($name, 'Services\\'));

        $stub = str_replace('{{ class }}', $className, $stub);
        $stub = str_replace('{{ folder_path }}', $folderPath, $stub);
        return str_replace('{{ class_name }}', str_replace( 'Service', '', $className), $stub);
    }
}
