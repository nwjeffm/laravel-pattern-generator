<?php

namespace NuWorks\PatternGenerator\Core\Commands;

use Symfony\Component\Console\Input\InputOption;
use NuWorks\PatternGenerator\Core\BaseCommand;

class BindingsServiceProviderMakeCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:pg-bindings-service-provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new pattern generator - bindings service provider.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->setCommandDeclaredType('Service Provider');
        $this->setCommandDeclaredNamespace('Providers\Bindings');
        $this->setCommandDeclaredClassSuffix('ServiceProvider');
        $this->setCommandDeclaredStubPath(__DIR__ . '/../Stubs/BindingsServiceProvider.stub');

        if (parent::fire() === false) {
            return;
        }

        $this->info($this->getCommandDeclaredType() . ' says the config generated code: "' . $this->commandResponseInfo() . '"');
    }

    /**
     * Command response info.
     *
     * @return string
     */
    private function commandResponseInfo()
    {
        $configCode = '';
        $configCode .= 'App\Providers\Bindings\\';
        
        if ($this->getFolderOptionInput()) {
            $configCode .= $this->getFolderOptionInput() . '\\'; 
        }
        
        $configCode .= $this->getNameInput() .'ServiceProvider::class';

        return $configCode;
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
