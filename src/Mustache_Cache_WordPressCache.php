<?php
namespace Khromov\Mustache_Cache;

/**
 * Mustache Cache filesystem implementation using WP Object Cache
 */
class Mustache_Cache_WordPressCache extends \Mustache_Cache_AbstractCache
{
  var $key_prefix = '';
  var $group = '';

  /**
   * Constructor. Allows you to set a key prefix and
   * the Object Cache group to use.
   *
   * Setting a custom prefix or group isn't required, see:
   * https://github.com/bobthecow/mustache.php/issues/246
   *
   * @param string $key_prefix
   * @param string $group
   */
  public function __construct($key_prefix = '', $group = 'mustache-cache')
  {
    $this->key_prefix = $key_prefix;
    $this->group = $group;

    //Add to global cache group so that we do not cache the same templates multiple times on multisite
    if ( function_exists( 'wp_cache_add_global_groups' ) ) {
      wp_cache_add_global_groups(array($group));
    }
  }

  /**
   * Load the class from cache.
   *
   * @param string $key
   * @return boolean
   */
  public function load($key)
  {
    $key = $this->key_prefix . $key;

    if(($value = wp_cache_get($key, $this->group)) !== false)
    {
      $this->log(\Mustache_Logger::DEBUG, 'Loaded from WP Object Cache: "{key}"', array('key' => $key));
      eval('?>' . $value);
      return true;
    }
    else
    {
      $this->log(\Mustache_Logger::DEBUG, 'Cache miss from WP Object Cache: "{key}"', array('key' => $key));
      return false;
    }
      
  }

  /**
   * Cache and load the compiled class.
   *
   * @param string $key
   * @param string $value
   *
   * @return void
   */
  public function cache($key, $value)
  {
    $key = $this->key_prefix . $key;

    $this->log(\Mustache_Logger::DEBUG, 'Adding to WP Object Cache cache: "{key}"', array('key' => $key));
    wp_cache_set($key, $value, $this->group);
    eval('?>' . $value);
  }
}
