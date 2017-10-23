<?php

namespace LordDashMe\PatternGenerator\Core\Traits;

trait MakeDirectory 
{
	/**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->getFiles()->isDirectory(dirname($path))) {
            
            $this->getFiles()->makeDirectory(dirname($path), 0777, true, true);
        }
    }
}