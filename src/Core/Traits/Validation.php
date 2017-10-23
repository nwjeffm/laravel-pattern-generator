<?php

namespace LordDashMe\PatternGenerator\Core\Traits;

trait Validation 
{
	/**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($path)
    {
        return $this->getFiles()->exists($path);
    }
}