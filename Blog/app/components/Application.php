<?php
namespace app\components;

use app\components\controller\BaseController;
use app\components\router\BaseRouter;

class Application
{
  private $router;

  public function __construct(BaseRouter $router)
  {
    $this->router = $router;
  }

  public function run()
  {
    $router = $this->router;

    if (!$router->getControllerName()) {
      $router->setControllerName(BaseController::DEFAULT_CONTROLLER_NAME);
    }

    if (!$router->getActionName()) {
      $router->setActionName(BaseController::DEFAULT_ACTION_NAME);
    }

    $controllerClassname = 'app\\controllers\\' . $router->getControllerName();

    if (!class_exists($controllerClassname)) {
      throw new \RuntimeException('Controller '.$router->getControllerName().' does not exist');
    }

    if (!method_exists($controllerClassname, $router->getActionName())) {
      throw new \RuntimeException('Action '.$router->getControllerName().'::'.$router->getActionName().' does not exist');
    }

    // run action
    $action = $router->getActionName();
    $result = (new $controllerClassname(
      $this->router
    ))->$action();

    if (!is_array($result)) {
      $result = [$result];
    }

    // wrap result and send response
    $response = new Response($result);
    $response->setRouter($this->router);

    return $response;
  }
}