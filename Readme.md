# tiny-ssi

A minimal implementation of Apache SSI (server-side includes) for PHP 5.4+


## Usage

Currently only supports doing includes, set var and echo var.

```html

 <!--#include virtual="header.html" -->

    <div class="container">
        <h1>title</h1>
        <p class="lead">
          contents
        </p>
    </div>
 <!--#include virtual="footer.html" -->

```

expecting that 'header.html' and 'footer.html' are in the same folder as the above html file,
you can then do:

```php
require_once('tiny_ssi.php');

$parser = new TinySSI;
echo $parser->parse('/test/ssi_test_body.html');
```

## License

MIT
