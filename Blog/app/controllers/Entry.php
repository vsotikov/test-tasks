<?php
namespace app\controllers;

use app\components\controller\BaseController;
use app\models\lowlevel\Comments;
use app\models\lowlevel\Entries;

class Entry extends BaseController
{
  public function view()
  {
    $id = (int)$this->getParam('id');

    $model = new Entries();
    $entry = $model->fetchById($id);

    if (!$entry) {
      throw new \InvalidArgumentException('Entry with id '.$id.' not found');
    }

    return [
      'entry' => $entry,
      'comments' => $this->getComments($entry->getId()),
    ];
  }

  public function add()
  {

  }

  public function doadd()
  {
    $currentUser = $this->getCurrentUser();

    if (!$currentUser) {
      throw new \LogicException('You must be logged in to add new entry');
    }

    $params = $this->getParams();

    $title = (string)$this->getParam('title');
    $text = (string)$this->getParam('text');

    if (!$title || !$text) {
      throw new \InvalidArgumentException('You must provide entry title and text');
    }



    $model = new Entries();
    $entry = $model->insert([
      'author_id' => $currentUser->getUserId(),
      'title' => $title,
      'text' => $text,
    ]);

    $this->redirect('/entry/view?id=' . $entry->getId());
  }

  private function getComments(int $entryId) : array
  {
    $model = new Comments();

    return $model->getComments($entryId);
  }

}