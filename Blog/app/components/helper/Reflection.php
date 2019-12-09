<?php
namespace app\components\helper;

class Reflection
{
  /**
   * Checks wether $classname extends $extendsClassname
   *
   * @param string $classname
   * @param string $checkedClassname
   * @return bool
   */
  public static function isInstanceof(string $classname, string $extendsClassname) : bool
  {
    try {
      $reflection = new \ReflectionClass($classname);

      return $reflection->isSubclassOf($extendsClassname);
    } catch (\ReflectionException $e) {
      return false;
    }
  }
}