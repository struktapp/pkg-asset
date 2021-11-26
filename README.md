Strukt Asset
===

Simple Asset Manager

```php
$finder = new Asset($root_dir, $static_dir);
$finder->exists("/js/script.js");
$finder->getInfo("/js/script.js");//SplFileInfo
$finder->get("/js/script.js");//returns contents of file
```
