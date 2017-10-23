**PATTERN GENERATOR (LARAVEL)**

This package provides a variety of generator commands to speed up your development process. These includes:

- `make:pg-trait`
- `make:pg-model`
- `make:pg-service`
- `make:pg-repository-interface`
- `make:pg-bindings-service-provider`

**REQUIREMENTS**
- Laravel 5.2 and below

**INSTALLATION**
Edit your project's `composer.json` file to require `nuworks/laravel-pattern-generator`.

    "require-dev": {
         "nuworks/laravel-pattern-generator": "dev-master"
    }

Next, update Composer from the Terminal:

    composer update --dev

Once this operation completes, open `config/app.php` and add a new item to the providers array.

    NuWorks\PatternGenerator\Core\PatternGeneratorServiceProvider::class

Do a Composer dump to refresh your autoload files.

    composer dump-autoload -o

You're all set to go! Run the `artisan` command from the Terminal to see the new `make` commands.

    php artisan

**USAGE**

Create a new trait by using `make:pg-trait`.

    php artisan make:pg-trait {trait} --folder={directory}

Create a new model by using `make:pg-model`.

    php artisan make:pg-model {model} --folder={directory}

Create a new service altogether with model.

    php artisan make:pg-service {model} --model --folder={directory}

Create a repository interface.

    php artisan make:pg-repository-interface {interface} --folder={directory}

Create a bindings service provider.

    php artisan make:pg-bindings-service-provider {service-provider} --folder={directory}