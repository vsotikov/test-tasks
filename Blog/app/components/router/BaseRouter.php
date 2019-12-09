<?php
namespace app\components\router;

use app\components\helper\Reflection;

class BaseRouter
{
  const ROUTER_REQUEST_URI = 'RequestUri';

  protected $actionName = '';
  protected $controllerName = '';
  protected $queryParams = [];

  /**
   * Create an instance of router by input type
   *
   * @param string $type
   * @return BaseRouter
   * @throws \ReflectionException
   */
  public static function create(string $type) : BaseRouter
  {
    $classname = __NAMESPACE__ . '\\' . $type;

    if (!class_exists($classname)) {
      throw new \InvalidArgumentException('Router '.$type.' is not supported');
    }

    if (!Reflection::isInstanceof($classname, self::class)) {
      throw new \InvalidArgumentException('Router '.$type.' should be a subclass of ' . self::class);
    }

    return new $classname();
  }

  public function getControllerName(): string
  {
    return $this->controllerName;
  }

  public function getActionName(): string
  {
    return $this->actionName;
  }

  public function setControllerName(string $value): BaseRouter
  {
    $this->controllerName = $value;

    return $this;
  }

  public function setActionName(string $value): BaseRouter
  {
    $this->actionName = $value;

    return $this;
  }

  public function getQueryParams() : array
  {
    return $this->queryParams;
  }

  public function getPostParams() : array
  {
    return $_POST;
  }

  public function getParams() : array
  {
    return array_merge(
      $this->getQueryParams(),
      $this->getPostParams()
    );
  }
}