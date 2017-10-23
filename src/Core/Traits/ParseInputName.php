<?php

namespace LordDashMe\PatternGenerator\Core\Traits;

use Illuminate\Support\Str;

trait ParseInputName 
{
	/**
     * Parse the name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function parseName($name)
    {
        $rootNamespace = $this->getLaravelRootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {

            return $name;
        }

        $name = $this->sanitizedPath($name);

        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    private function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\' . $this->getCommandNamespace();
    }

    /**
     * Get the namespace for the generator.
     * This will set the system folder | folder of the module. 
     *
     * @return string
     */
    private function getCommandNamespace()
    {
        $concrete_namespace = $this->getCommandDeclaredNamespace();

        if ($this->hasOption('system-folder')) {

            $concrete_namespace = $concrete_namespace . '\\' . $this->option('system-folder');
        }

        if ($this->hasOption('folder')) {
            
            if ($this->option('folder')) {
                
                $concrete_namespace = $concrete_namespace . '\\' . $this->option('folder'); 
            }
        }

        return $this->sanitizedPath($concrete_namespace);
    }

    /**
     * Convert the path if detected a different slash. 
     *
     * @param  string  $str
     * @return string
     */
    private function sanitizedPath($str)
    {
        if (Str::contains($str, '/')) {
            
            $str = str_replace('/', '\\', $str);
        }

        return $str;
    }
}
