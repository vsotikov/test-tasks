<?php
namespace app\models\lowlevel;

use app\components\model\BaseModel;

class Users extends BaseModel
{
  public function fetchById(int $userId) : array
  {
    $stmt = $this->adapter->prepare(
      'select * from users where id = :id'
    );

    $stmt->execute(['id' => $userId]);

    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return empty($result) ? [] : array_pop($result);
  }

  public function fetchByUserPass(string $username, string $password) : array
  {
    $stmt = $this->adapter->prepare(
      'select * from users where username = :username and password = :password limit 1'
    );

    $stmt->execute([
      'username' => $username,
      'password' => $password,
    ]);

    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return empty($result) ? [] : array_pop($result);
  }
}