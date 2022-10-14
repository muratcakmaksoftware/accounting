<?php

namespace App\Console\Commands\Creators;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use function base_path;

class RepositoryCreator extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository';

    protected $type = 'Repository';

    public function handle()
    {
        $this->input->setArgument('name', $this->argument('name').'Repository');
        parent::handle();
    }

    protected function getStub(){
        return base_path('stubs/class-repository.stub');
    }

    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Repositories';
    }

    protected function replaceClass($stub, $name){
        $className = str_replace($this->getNamespace($name).'\\', '', $name);
        $folderPath = str_replace($className, '', Str::afterLast($name, 'Repositories\\'));

        $stub = str_replace('{{ class }}', $className, $stub);
        $stub = str_replace('{{ folder_path }}', $folderPath, $stub);
        return str_replace('{{ class_name }}', str_replace( 'Repository', '', $className), $stub);
    }
}
