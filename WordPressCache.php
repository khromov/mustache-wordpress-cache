<?php
/**
 * Mustache Cache filesystem implementation using WP Object Cache
 */
class Mustache_Cache_WordPressCache extends Mustache_Cache_AbstractCache
{
  const GROUP = 'mustache-cache';

  /**
   * Filesystem cache constructor.
   */
  public function __construct()
  {
  }

  /**
   * Load the class from cache
   *
   * @param string $key
   * @return boolean
   */
  public function load($key)
  {
    $this->log(Mustache_Logger::DEBUG, 'Loaded from WP Object Cache cache: "{key}"', array('key' => $key));
    if(($value = wp_cache_get($key, self::GROUP)) !== false)
    {
      eval('?>' . $value);
      return true;
    }
    else
      return false;
  }

  /**
   * Cache and load the compiled class
   *
   * @param string $key
   * @param string $value
   *
   * @return void
   */
  public function cache($key, $value)
  {
    $this->log(Mustache_Logger::DEBUG, 'Adding to WP Object Cache cache: "{key}"', array('key' => $key));
    wp_cache_set($key, $value, self::GROUP);
    eval('?>' . $value);
  }
}