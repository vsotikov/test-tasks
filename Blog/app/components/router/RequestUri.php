<?php
namespace app\components\router;

class RequestUri extends BaseRouter
{
  public function __construct($requestUri = null)
  {
    if (null === $requestUri) {
      $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    }

    $this->init($requestUri);
  }

  /**
   * Initialize router with input request uri
   *
   * @param $requestUri
   */
  private function init($requestUri)
  {
    $parsed = parse_url($requestUri);
    $parsedQuery = [];

    $query = $parsed['query'] ?? '';
    $path = array_values(array_filter(
      explode('/', $parsed['path'] ?? '')
    ));
    parse_str($query, $parsedQuery);

    if (count($path) > 2) {
      throw new \RuntimeException('Path MUST match /&lt;controller&gt;/&lt;action&gt; pattern');
    }

    $this->controllerName = $path[0] ?? '';
    $this->actionName = $path[1] ?? '';
    $this->queryParams = $parsedQuery;
  }
}