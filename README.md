## WordPress Cache for Mustache.php

WordPress Cache adapter for Mustache.php

Uses the [WordPress Object cache](http://codex.wordpress.org/Class_Reference/WP_Object_Cache).

#### Example

```php

$mustache = new Mustache_Engine( array(
    ...
    'cache'           => new Mustache_Cache_WordPressCache()
    ...
  ) );
```