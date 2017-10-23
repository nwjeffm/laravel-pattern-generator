<?php

namespace NuWorks\PatternGenerator\Core\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use NuWorks\PatternGenerator\Core\BaseCommand;

class ServiceMakeCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:pg-service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new pattern generator - service class.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->setCommandDeclaredType('Service');
        $this->setCommandDeclaredNamespace('Services');
        $this->setCommandDeclaredClassSuffix('Service');
        $this->setCommandDeclaredStubPath(__DIR__ . '/../Stubs/Service.stub');

        if (parent::fire() === false) {
            return;
        }

        if ($this->option('model')) {
            $this->createModel();
        }

        if ($this->option('repository-interface')) {
            $this->createRepositoryInterface();
        }

        if ($this->option('bindings-service-provider')) {
            $this->createBindingsServiceProvider();
        }
    }

    /**
     * Call the create a model if the option for model detected.
     *
     * @return void
     */
    private function createModel()
    {
        $this->call('make:pg-model', [
            'name' => Str::singular($this->getNameInput()),
            '--folder' => $this->getFolderOptionInput()
        ]);
    }

    /**
     * Call the create a repository interface if the option
     * for repository interface detected.
     *
     * @return void
     */
    private function createRepositoryInterface()
    {
        $this->call('make:pg-repository-interface', [
            'name' => $this->getNameInput(),
            '--folder' => $this->getFolderOptionInput()
        ]);
    }

    /**
     * Call the create a binding service provider if the option
     * for binding service provider detected.
     *
     * @return void
     */
    private function createBindingsServiceProvider()
    {
        $this->call('make:pg-bindings-service-provider', [
            'name' => $this->getNameInput(),
            '--folder' => $this->getFolderOptionInput()
        ]);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['folder', 'f', InputOption::VALUE_REQUIRED, 'Group your class files using folder option.'],
            ['model', 'm', InputOption::VALUE_NONE, 'Create a new pattern generator - model class.'],
            ['repository-interface', 'ri', InputOption::VALUE_NONE, 'Create a new pattern generator - repository interface.'],
            ['bindings-service-provider', 'bsp', InputOption::VALUE_NONE, 'Create a new pattern generator - bindings service provider.'],
        ];
    }
}
