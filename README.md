# Yaf 

## Requirement

- PHP >= 7.0
- Yaf >= 3.0

## Installation

1. Update `yaf.ini`:
```init
[yaf]
yaf.use_namespace=1
yaf.use_spl_autoload=1
...
```

2. Web server rewrite rules:

    #### Apache

    ```conf
    #.htaccess
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule .* index.php
    ```

    #### Nginx

    ```
    server {
      listen 80;
      server_name  myapp.com;
      root   /path/to/myapp;
      index  index.php index.html index.htm;

      if (!-e $request_filename) {
        rewrite ^/(.*)  /index.php/$1 last;
      }
    }
    ```

    #### Lighttpd

    ```
    $HTTP["host"] =~ "(www.)?myapp.com$" {
      url.rewrite = (
         "^/(.+)/?$"  => "/index.php/$1",
      )
    }
    ```
## Todo
 - Command
 - Validate
