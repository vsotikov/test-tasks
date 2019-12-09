<?php
namespace app\models\lowlevel;

use app\components\model\BaseModel;
use app\models\Entry;

class Entries extends BaseModel
{
  public function getEntries(int $limit, int $offset) : array
  {
    $result = [];

    $stmt = $this->adapter->prepare(
      'select * from entries order by created_at desc limit :limit offset :offset'
    );

    $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

    $stmt->execute();

    $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($data as $entry) {
      $result[] = new Entry($entry);
    }

    return $result;
  }

  public function getTotalEntries() : int
  {
    $result = $this->adapter->query(
      'select count(*) from entries'
    );

    return $result->fetchColumn(0);
  }

  public function fetchById(int $id) : ?Entry
  {
    $stmt = $this->adapter->prepare(
      'select * from entries where id = :id'
    );

    $stmt->execute(['id' => $id]);

    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return empty($result) ? null : new Entry(array_pop($result));
  }

  public function insert(array $params) : Entry
  {
    // TODO Validate input params

    $stmt = $this->adapter->prepare(
      'insert into entries (title, text, author_id) values (:title, :text, :author_id)'
    );

    $stmt->bindParam(':title', $params['title'], \PDO::PARAM_STR);
    $stmt->bindParam(':text', $params['text'], \PDO::PARAM_STR);
    $stmt->bindParam(':author_id', $params['author_id'], \PDO::PARAM_INT);

    $result = $stmt->execute();

    if (!$result) {
      throw new \Exception('Error creating new entry');
    }

    return $this->fetchById(
      $this->adapter->lastInsertId()
    );
  }
}