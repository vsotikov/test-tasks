<?php
namespace app\models\lowlevel;

use app\components\model\BaseModel;
use app\models\Comment;

class Comments extends BaseModel
{
  public function getComments(int $entryId) : array
  {
    $result = [];

    $stmt = $this->adapter->prepare(
      'select *, inet_ntoa(ip) as ip from comments where entry_id = :entry_id order by created_at desc'
    );

    $stmt->bindParam(':entry_id', $entryId, \PDO::PARAM_INT);

    $stmt->execute();

    $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($data as $entry) {
      $result[] = new Comment($entry);
    }

    return $result;
  }
}