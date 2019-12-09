<?php
namespace app\models;

class Comment
{
  protected $data;

  public function __construct(array $data)
  {
    if (empty($data)) {
      throw new \InvalidArgumentException('Data is empty');
    }

    $this->data = $data;
  }

  public function getIp() : string
  {
    return $this->data['ip'] ?? '';
  }

  public function getAuthorId() : int
  {
    return $this->data['author_id'];
  }

  public function getAuthor() : User
  {
    return new User(
      $this->getAuthorId()
    );
  }

  public function getCreatedAt() : \DateTime
  {
    return new \DateTime($this->data['created_at']);
  }

  public function getComment() : string
  {
    return $this->data['comment'];
  }
}