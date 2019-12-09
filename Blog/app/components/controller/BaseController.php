<?php
namespace app\components\controller;

use app\components\router\BaseRouter;
use app\components\ServiceLocator;
use app\models\User;

abstract class BaseController
{
  const DEFAULT_CONTROLLER_NAME = 'Home';
  const DEFAULT_ACTION_NAME = 'index';

  protected $router;

  public function __construct(BaseRouter $router)
  {
    $this->router = $router;
  }

  protected function redirect(string $url, int $code = 302)
  {
    header("Location: $url", true, $code);
    exit;
  }

  protected function getParams() : array
  {
    return $this->router->getParams();
  }

  protected function getParam($name)
  {
    $params = $this->getParams();

    return $params[$name] ?? null;
  }

  protected function getCurrentUser() : ?User
  {
    try {
      return ServiceLocator::get('currentUser');
    } catch (\InvalidArgumentException $e) {
      return null;
    }
  }
}