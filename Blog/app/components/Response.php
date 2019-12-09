<?php
namespace app\components;

use app\components\router\BaseRouter;
use app\components\view\Renderer;

class Response
{
  private $router;

  private $result;

  public function __construct(array $result)
  {
    $this->result = $result;
  }

  public function setRouter(BaseRouter $router) : Response
  {
    $this->router = $router;

    return $this;
  }

  public function output()
  {
    /** @var Renderer $view */
    $view = ServiceLocator::get('view');

    $view->setVars($this->result);

    $view->render(
      $view->getTemplateFromRouter($this->router)
    );
  }
}