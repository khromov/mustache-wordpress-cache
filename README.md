## WordPress Cache for Mustache.php

WordPress cache adapter for Mustache.php

Uses the [WordPress Object cache](http://codex.wordpress.org/Class_Reference/WP_Object_Cache).

#### Example

```php
$mustache = new Mustache_Engine( array(
    ...
    'cache'           => \Khromov\Mustache_Cache\Mustache_Cache_WordPressCache()
    ...
  ) );
```

#### Constructor parameters

You don't have to pass anything when constructing the cache, but you can pass the following parameters if you want:

**$key_prefix** - The object cache key prefix to use. (Default: "")  
**$group** - The object cache group to use. (Default: "mustache-cache")