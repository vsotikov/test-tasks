<?php
namespace app\controllers;

use app\components\controller\BaseController;
use app\models\lowlevel\Entries;

class Home extends BaseController
{
  public function index()
  {
    // get 3 recent entries
    $model = new Entries();

    $page = (int)$this->getParam('page');
    if ($page < 1) {
      $page = 1;
    }

    $limit = 3;
    $offset = ($page - 1) * $limit;

    $entries = $model->getEntries($limit, $offset);
    $totalEntries = $model->getTotalEntries();

    $entriesSkipped = $limit + $offset;

    $previousPage = $totalEntries > $entriesSkipped
      ? $page + 1
      : 0;

    return [
      'entries' => $entries,
      'previousPage' => $previousPage,
    ];
  }
}