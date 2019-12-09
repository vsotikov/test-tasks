<?
use app\components\helper\Entry as EntryHelper;
/** @var \app\models\Entry $entry */
$entry = $this->entry;
?>

<div class="entry">
  <h2><?= EntryHelper::formatDate($entry->getCreatedAt()) ?>: <?= $entry->getTitle() ?></h2>
  <p><?= $entry->getText() ?></p>
  <span>Author: <?= $entry->getAuthor()->getUsername() ?></span>
</div>

<div class="comments">
  <? include 'partial/comments.php' ?>
</div>
