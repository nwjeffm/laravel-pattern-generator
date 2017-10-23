<?php

namespace LordDashMe\PatternGenerator\Core\Commands;

use Symfony\Component\Console\Input\InputOption;
use LordDashMe\PatternGenerator\Core\BaseCommand;

class TraitMakeCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:pg-trait';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new pattern generator - trait class.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->setCommandDeclaredType('Trait');
        $this->setCommandDeclaredNamespace('Http\Traits');
        $this->setCommandDeclaredClassSuffix('Trait');
        $this->setCommandDeclaredStubPath(__DIR__ . '/../Stubs/Trait.stub');

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
            ['system-folder', 'sf', InputOption::VALUE_REQUIRED, 'The System Folder [Admin | Web] Categories for modules.'],
            ['folder', 'f', InputOption::VALUE_REQUIRED, 'Group your class files using folder option.'],
        ];
    }
}
