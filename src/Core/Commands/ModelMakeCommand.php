<?php

namespace LordDashMe\PatternGenerator\Core\Commands;

use Symfony\Component\Console\Input\InputOption;
use LordDashMe\PatternGenerator\Core\BaseCommand;

class ModelMakeCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:pg-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new pattern generator - model class.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->setCommandDeclaredType('Model');
        $this->setCommandDeclaredNamespace('Models');
        $this->setCommandDeclaredClassSuffix('');
        $this->setCommandDeclaredStubPath(__DIR__ . '/../Stubs/Model.stub');

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
