<?php
namespace app\components\auth;

class AuthResult
{
  private $data = [];

  public function __construct(array $data = null)
  {
    if (is_array($data)) {
      $this->data = $data;
    }
  }

  public function getUserData() : array
  {
    return $this->data;
  }

  public function isAuthenticated() : bool
  {
    return !empty($this->data);
  }

  public function getUserId() : ?int
  {
    return $this->data['id'] ?? null;
  }
}