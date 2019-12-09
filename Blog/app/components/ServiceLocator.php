<?php
namespace app\components;

final class ServiceLocator
{
  private static $objects = [];

  public static function set(string $name, $object)
  {
    self::$objects[$name] = $object;
  }

  public static function get(string $name)
  {
    if (!isset(self::$objects[$name])) {
      throw new \InvalidArgumentException('No service registered under name ' . $name);
    }

    if (self::$objects[$name] instanceof \Closure) {
      $object = self::$objects[$name];
      self::$objects[$name] = $object();
    }

    return self::$objects[$name];
  }
}