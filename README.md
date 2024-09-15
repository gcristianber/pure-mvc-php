# Pure PHP MVC Based with Routing System 
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/gcristianber/)
[![LinkedIn](https://img.shields.io/badge/Facebook-Connect-brightgreen?style=for-the-badge&labelColor=blue&logo=facebook)](https://www.facebook.com/profile.php?id=100080436475426)

'Pure MVC PHP' is came out from out-of-nowhere, I don't know what to name within this repository, If you want to explore PHP more without any framework with MVC structure you can fork this and try your own.

## Installation

Clone the 'sample-pure-php' repository:

```bash
$ git clone https://github.com/gcristianber/sample-pure-php.git
```

Install the composer packages:
```bash
$ composer update
```

Install the NPM packages:
```bash
$ npm install
```

Run the program:
```bash
$ php -S localhost:81
```

## Usage

### Adding a route

Navigate to the index.php in your `ROOT` folder and add your routes inside this code block of dispatcher.

```php
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [App\Controllers\IndexController::class, 'index']);
    $r->addRoute('GET', '/self-invoke', function () {
        echo "Hello Self Invoke";
    });

    // Add more routes...
});
```

You can read the sample documentation of this `FastRoute` here [here](https://gist.github.com/Yiannistaos/ff4d1989ebba4fd8eca68e71524a494c)

_Note: The main repository of **FastRoute** implementation seems outdated so I found this gist to guide you on how to implement it using `RouteCollector` not `ConfigureRoutes`_



Happy coding! **PHP is not dead lol**
