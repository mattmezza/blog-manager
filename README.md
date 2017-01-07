[![Travis](https://img.shields.io/travis/mattmezza/blog-manager.svg)]()
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/mattmezza/blog-manager.svg)]()
[![Scrutinizer](https://img.shields.io/scrutinizer/g/mattmezza/blog-manager.svg)]()
[![Packagist](https://img.shields.io/packagist/v/mattmezza/blog-manager.svg)]()

blog-manager
=====

A PHP utility class to manage a small blog with files and markdown syntax

`composer require mattmezza/blog-manager`

```php
require_once 'vendor/autoload.php';

$config = array(
  "posts" => array(
    "dir" => __DIR__ . "/posts",
    "perpage" => 5
  ),
  "pages" => array(
    "dir" => __DIR__ . "/pages/"
  ),
  "url" => "http://localhost:8000"
);

$bm = new Blog\Manager($config);
$page = $bm->get_page("test");

// echo $page->title;
echo $page->body;
// echo $page->metas->wooow;
```

`test.md`

```
title: test
wooow: 'YAML syntax'
------------
# Test
Let's _try_
```




###### Matteo Merola <mattmezza@gmail.com>
