<?php
namespace app\models;

use app\models\lowlevel\Users;

class User
{
  protected $data = [];

  public function __construct($data = null)
  {
    if (is_array($data)) {
      $this->data = $data;
    }

    elseif (is_int($data)) {
      $this->data = (new Users())->fetchById($data);
    }
  }

  public function getUserId() : ?int
  {
    return $this->data['id'] ?? null;
  }

  public function getUsername() : string
  {
    return $this->data['username'] ?? '';
  }
}