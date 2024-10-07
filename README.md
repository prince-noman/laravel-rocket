### Laravel Rocket

`laravel-rocket` is a Laravel package that provides a set of commands to generate multiple resources (controllers, models, migrations, requests, factories, and seeders) in one go, allowing you to streamline your Laravel development process.

### Features

- Generate multiple controllers, models, migrations, requests, factories, and seeders with a single command.

- Option to create resource controllers.

- Supports Laravel 9 or above.

### Installation

> Step 1: Install the package in development, you can use the --dev flag

```
composer require prince/laravel-rocket --dev
```

> Step 2: Publish the Configuration (if needed)
> If your package has any configuration files, you can publish them using:

```
php artisan vendor:publish --provider="Prince\LaravelRocket\LaravelRocketServiceProvider"
```

> Step 3: Register the Service Provider (for Laravel 10 or below)
> If you are using Laravel 9 or below, you may need to register the service provider manually in your config/app.php file:

```
'providers' => [
    // Other Service Providers

    Prince\LaravelRocket\LaravelRocketServiceProvider::class,
],

```

### Usage

The package provides several artisan commands to create multiple resources at once.

> 1. Create Multiple Controllers in one command:

```bash
php artisan make:controllers Product Order Invoice
```

This command will generate:

```
ProductController
OrderController
InvoiceController
```

> 2. Create Resource Controllers in one command, use the --resource or -r option:

```bash
php artisan make:controllers Product Order Invoice -r
```

This will create:

```
ProductController (as a resource controller)
OrderController (as a resource controller)
InvoiceController (as a resource controller)
```

> 3. Create Multiple Models in one command:

```bash
php artisan make:models Product Order Invoice
```

This will create:

```
Product model
Order model
Invoice model
```

Optionally, to create models with migrations:

```bash
php artisan make:models Product Order Invoice -m
```

> 4. Create Multiple Migrations for multiple models in one command:

```bash
php artisan make:migrations Product Order Invoice
```

> 5. Create Multiple Form request classes in one command:

```bash
php artisan make:requests CreateProductRequest UpdateProductRequest
```

> 6. Create Multiple Factories in one command:

```bash
php artisan make:factories Product Order Invoice
```

> 7. Create Multiple Seeders in one command:

```bash
php artisan make:seeders Product Order Invoice
```

- Contributing
  > Contributions are welcome! If you find any bugs or want to add new features, feel free to open an issue or submit a pull request.

License
The laravel-rocket package is open-source software licensed under the [MIT](./LICENSE.md) license.
