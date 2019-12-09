<?php
namespace app\controllers;

use app\components\auth\AuthAdapter;
use app\components\controller\BaseController;

class Auth extends BaseController
{
  public function login()
  {
    if ($this->getCurrentUser()->getUserId()) {
      $this->redirect('/');
    }

    return [];
  }

  public function dologin()
  {
    $params = $this->getParams();
    $username = $params['username'] ?? '';
    $password = md5($params['password'] ?? '');

    $adapter = new AuthAdapter();

    $result = $adapter->authenticate($username, $password);

    if ($result->isAuthenticated()) {
      setcookie(
        AuthAdapter::COOKIE_NAME,
        serialize([
          'username' => $username,
          'password' => $password
        ]),
        time() + 60*60*24*30,
        '/',
        $_SERVER['HTTP_HOST'],
        0
      );
    }

    $this->redirect('/');
  }

  public function logout()
  {
    setcookie(
      AuthAdapter::COOKIE_NAME,
      '',
      time(),
      '/',
      $_SERVER['HTTP_HOST'],
      0
    );

    $this->redirect('/');
  }
}