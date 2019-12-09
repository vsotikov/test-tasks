<?php
namespace app\components\auth;

use app\models\lowlevel\Users;

class AuthAdapter
{
  const COOKIE_NAME = 'blog_auth';

  public function authenticate(string $username, string $password) : AuthResult
  {
    $model = new Users();
    $data = $model->fetchByUserPass($username, $password);

    return new AuthResult($data);
  }

  public function checkAuthentication() : AuthResult
  {
    $cookie = $_COOKIE[self::COOKIE_NAME] ?? '';

    if ($cookie) {
      $data = unserialize($cookie);

      return $this->authenticate(
        $data['username'] ?? '',
        $data['password'] ?? ''
      );
    }

    return new AuthResult();
  }
}