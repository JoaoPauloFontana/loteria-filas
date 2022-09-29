## Instalation

In order to run this boilerplate, make sure to have installed at least:

- php >= v8.0
- composer >= v1.8.5

Then run the following commands in your command line to install dependencies:

- composer install

* first time run aditional steps

  - rename .env.example to .env
  - run php artisan key:generate
  - run php artisan migrate
   
To init the project and compile assets use:

- php artisan serve

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
