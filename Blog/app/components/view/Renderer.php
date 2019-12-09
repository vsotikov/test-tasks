<?php
namespace app\components\view;

use app\components\Response;
use app\components\router\BaseRouter;
use app\components\ServiceLocator;

class Renderer
{
  public function __get($name)
  {
    if (!isset($this->{$name})) {
      // try to search in service locator
      try {
        $object = ServiceLocator::get($name);

        return $object;
      } catch (\InvalidArgumentException $e) {
      }
    }

    return null;
  }

  public function fetch(string $template) : string
  {
    $content = '';

    $layout = APP_ROOT . DS . 'views/layout.php';

    ob_start();
    include $layout;
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
  }

  public function render(string $template)
  {
    print $this->fetch($template);
  }

  public function setVars(array $vars) : Renderer
  {
    foreach ($vars as $key => $value) {
      $this->{$key} = $value;
    }

    return $this;
  }

  public function getTemplateFromRouter(BaseRouter $router) : string
  {
    $template = $this->getBaseViewsPath() . DS .
      mb_strtolower($router->getControllerName()) . DS .
      mb_strtolower($router->getActionName()) . '.php';

    return $template;
  }

  private function getBaseViewsPath()
  {
    return APP_ROOT . DS . 'views';
  }
}