<?
use app\components\Application;
use app\components\router\BaseRouter;

require_once __DIR__ . '/bootstrap.php';

try {
  $router = BaseRouter::create(BaseRouter::ROUTER_REQUEST_URI);

  $response = (new Application($router))->run();

  $response->output();
} catch (Throwable $e) {
  print '<pre>';
  print_r($e);
  exit;
}