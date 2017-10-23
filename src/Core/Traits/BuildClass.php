<?php

namespace NuWorks\PatternGenerator\Core\Traits;

use Illuminate\Support\Str;

trait BuildClass 
{
	/**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->getFiles()->get($this->getCommandDeclaredStubPath());

        return $this->replaceNamespace($stub, $name)
            ->replaceClassNameSingular($stub, $name)
            ->replaceClassNameLowerCase($stub, $name)
            ->replaceClassName($stub, $name)
            ->replaceModuleFolder($stub, $name)
            ->replaceClass($stub, $name)
            
            ->sanitizeStub($stub, $name);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            '[[DummyNamespace]]', $this->getNamespace($name), $stub
        );

        return $this;
    }

    /**
     * Replace the class name into singular form for the given stub.
     * Used in the model class name declaration in "service stub".
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceClassNameSingular(&$stub, $name)
    {
        $stub = str_replace(
            '[[DummyClassNameSingular]]', Str::singular($this->getNameInput()), $stub
        );

        return $this;
    }

    /**
     * Replace the class name into lowercase form for the given stub.
     * Used in the model class name declaration in the "model stub".
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceClassNameLowerCase(&$stub, $name)
    {
        $stub = str_replace(
            '[[DummyClassNameLowerCase]]', Str::plural(Str::lower($this->getNameInput())), $stub
        );

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     * Used in the "service stub" and "binding service provider stub".
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceClassName(&$stub, $name)
    {
        $stub = str_replace(
            '[[DummyClassName]]', $this->getNameInput(), $stub
        );

        return $this;
    }

    /**
     * Replace the module folder name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceModuleFolder(&$stub, $name)
    {
        $stub = str_replace(
            '[[DummyModuleFolder]]', $this->getFolderOptionInput(), $stub
        );

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass(&$stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $stub = str_replace('[[DummyClass]]', $class, $stub);

        return $this; 
    }

    /**
     * Sanitize the stub before going to final stage of building.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function sanitizeStub($stub, $name)
    {
        return str_replace('\\\\', '\\', $stub);
    }

    /**
     * Get the full namespace name for a given class.
     *
     * @param  string  $name
     * @return string
     */
    protected function getNamespace($name)
    {
        $name = explode('\\', $name);
        
        unset($name[(count($name) - 1)]);

        $nameSpace = implode('\\', $name);

        return trim($nameSpace);
    }
}