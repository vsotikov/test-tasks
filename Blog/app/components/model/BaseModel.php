<?php
namespace app\components\model;

use app\components\ServiceLocator;

class BaseModel
{
  protected $adapter;

  public function __construct(\PDO $adapter = null)
  {
    if (null === $adapter) {
      $adapter = ServiceLocator::get('db');
    }

    $this->adapter = $adapter;
  }

  public function getAdapter() : \PDO
  {
    return $this->adapter;
  }
}