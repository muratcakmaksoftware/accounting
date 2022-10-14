<?php

namespace App\Console\Commands\Creators;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use function base_path;

class RepositoryInterfaceCreator extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository-interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository Interface';

    protected $type = 'RepositoryInterface';

    public function handle()
    {
        $this->input->setArgument('name', $this->argument('name').'RepositoryInterface');
        parent::handle();
    }

    protected function getStub(){
        return base_path('stubs/class-repository-interface.stub');
    }

    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Interfaces\\RepositoryInterfaces';
    }

    protected function replaceClass($stub, $name){
        $className = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('{{ class }}', $className, $stub);
    }
}
