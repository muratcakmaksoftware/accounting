<?php

namespace App\Console\Commands\Creators;

use Illuminate\Console\GeneratorCommand;
use function base_path;

class TraitCreator extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Trait';

    protected $type = 'Trait';

    public function handle()
    {
        $this->input->setArgument('name', $this->argument('name').'Trait');
        parent::handle();
    }

    protected function getStub(){
        return base_path('stubs/trait.stub');
    }

    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Traits';
    }

    protected function replaceClass($stub, $name){
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('{{trait_name}}', $class, $stub);
    }
}
