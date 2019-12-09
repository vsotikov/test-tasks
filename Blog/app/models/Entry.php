<?php
namespace app\models;

class Entry
{
  protected $data;

  public function __construct(array $data)
  {
    if (empty($data)) {
      throw new \InvalidArgumentException('Data is empty');
    }

    $this->data = $data;
  }

  public function getId() : int
  {
    return (int)$this->data['id'];
  }

  public function getTitle() : string
  {
    return (string)$this->data['title'];
  }

  public function getText() : string
  {
    return (string)$this->data['text'];
  }

  public function getAuthorId() : int
  {
    return (int)$this->data['author_id'];
  }

  public function getCreatedAt() : \DateTime
  {
    return new \DateTime(
      $this->data['created_at']
    );
  }

  public function getAuthor() : User
  {
    return new User(
      $this->getAuthorId()
    );
  }
}