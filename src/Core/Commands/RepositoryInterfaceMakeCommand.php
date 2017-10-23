<?php

namespace NuWorks\PatternGenerator\Core\Commands;

use Symfony\Component\Console\Input\InputOption;
use NuWorks\PatternGenerator\Core\BaseCommand;

class RepositoryInterfaceMakeCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:pg-repository-interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new pattern generator - repository interface.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->setCommandDeclaredType('Interface');
        $this->setCommandDeclaredNamespace('Repositories\Interfaces');
        $this->setCommandDeclaredClassSuffix('RepositoryInterface');
        $this->setCommandDeclaredStubPath(__DIR__ . '/../Stubs/RepositoryInterface.stub');

        if (parent::fire() === false) {
            return;
        }
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
        ];
    }
}
