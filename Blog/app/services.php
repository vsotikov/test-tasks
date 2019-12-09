<?php

use app\components\ServiceLocator;

// Register DB
ServiceLocator::set(
  'db',
  function () {
    return \app\components\db\Mysql::getPDO();
  }
);

// Register view renderer
ServiceLocator::set(
  'view',
  function () {
    return new \app\components\view\Renderer();
  }
);

// Current user
ServiceLocator::set(
  'currentUser',
  function () {
    $user = new \app\models\User();

    // check auth
    $authAdapter = new \app\components\auth\AuthAdapter();
    $result = $authAdapter->checkAuthentication();

    if ($result->isAuthenticated()) {
      $user = new \app\models\User(
        $result->getUserData()
      );
    }

    return $user;
  }
);
