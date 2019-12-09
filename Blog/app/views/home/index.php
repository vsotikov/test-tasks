<?
use app\components\helper\Entry as EntryHelper;
/** @var \app\models\Entry $entry */
?>

<? foreach ($this->entries as $entry): ?>
    <div class="entry">
        <h2><?= EntryHelper::formatDate($entry->getCreatedAt()) ?>: <?= $entry->getTitle() ?></h2>
        <p><?= EntryHelper::prepareText($entry->getText(), $entry) ?></p>
        <span>Author: <?= $entry->getAuthor()->getUsername() ?></span>
    </div>
<? endforeach; ?>

<? if($this->previousPage): ?>
    <a href="/?page=<?= $this->previousPage ?>">Previous entries</a>
<? endif ?>
