<?php

namespace LordDashMe\PatternGenerator\Core;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use LordDashMe\PatternGenerator\Core\Traits\BuildClass;
use LordDashMe\PatternGenerator\Core\Traits\Validation;
use LordDashMe\PatternGenerator\Core\Traits\MakeDirectory;
use LordDashMe\PatternGenerator\Core\Traits\ParseInputName;

abstract class BaseCommand extends Command
{
    use BuildClass, Validation, MakeDirectory, ParseInputName;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type;

    /**
     * Get the namespace or destination path. 
     *
     * @var string
     */
    protected $namespace;

    /**
     * Get the class suffix. 
     *
     * @var string
     */
    protected $classSuffix;

    /**
     * Get the path of the stub template for the generator.
     *
     * @var string
     */
    protected $stubPath;

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->setFiles($files);
    }

    /**
     * Set the file field.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    protected function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * Get the file field.
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    protected function getFiles()
    {
        return $this->files;
    }

    /**
     * Set the type field.
     *
     * @param  string  $type
     * @return void
     */
    protected function setCommandDeclaredType($type)
    {
        $this->type = $type;
    }

    /**
     * Get the type field.
     *
     * @return string
     */
    protected function getCommandDeclaredType()
    {
        return $this->type;
    }

    /**
     * Set the namespace field.
     *
     * @param  string  $namespace
     * @return void
     */
    protected function setCommandDeclaredNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Get the namespace field.
     *
     * @return string
     */
    protected function getCommandDeclaredNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set the class suffix field.
     *
     * @param  string  $classSuffix
     * @return void
     */
    protected function setCommandDeclaredClassSuffix($classSuffix)
    {
        $this->classSuffix = $classSuffix;
    }

    /**
     * Get the class suffix field.
     *
     * @return string
     */
    protected function getCommandDeclaredClassSuffix()
    {
        return $this->classSuffix;
    }

    /**
     * Set the stub path field.
     *
     * @param  string  $stubPath
     * @return void
     */
    protected function setCommandDeclaredStubPath($stubPath)
    {
        $this->stubPath = $stubPath;
    }

    /**
     * Get the stub path field.
     *
     * @return string
     */
    protected function getCommandDeclaredStubPath()
    {
        return $this->stubPath;
    }

    /**
     * Get the laravel root namespace.
     *
     * @return string
     */
    protected function getLaravelRootNamespace()
    {
        return $this->laravel->getNamespace();
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        // declaration of name input and command type here...
        $classSuffixInput = $this->getNameInput() . $this->getCommandDeclaredClassSuffix();
        $commandType = $this->getCommandDeclaredType();

        // prepare the input name and path here...
        $name = $this->parseName($classSuffixInput);
        $path = $this->getPath($name);

        // validate if the class file is already exists here...
        if ($this->alreadyExists($path)) {

            $this->error($commandType . ' already exists!');
            
            return false;
        }

        // make the directory and class file here...
        $this->makeDirectory($path);
        $this->getFiles()->put($path, $this->buildClass($name));

        // prompt if the class was created successfully here...
        $this->info($commandType . ' created successfully.');
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }

    /**
     * Get the folder option input.
     * 
     * @return string
     */
    protected function getFolderOptionInput()
    {
        return ($this->option('folder') ? trim($this->option('folder')) : '');
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {   
        $rootNamespace = $this->getLaravelRootNamespace();

        $name = str_replace_first($rootNamespace, '', $name);
        
        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the pattern generator - class.'],
        ];
    }
}
