<?
$countComments = count($this->comments);
$showIp = ($this->currentUser->getUserId() == $this->entry->getAuthorId());
?>

<? if($countComments): ?>
  <p><?= $countComments ?> comment yet:</p>

  <ol>
    <? foreach($this->comments as $comment): ?>
      <li>
        <p><?= $comment->getAuthor()->getUsername() ?> said: (<?= $comment->getCreatedAt()->format('d.m.Y H:i') ?><? if($showIp): ?> IP: <?= $comment->getIp() ?><? endif ?>):</p>
        <p><?= $comment->getComment() ?></p>
      </li>
    <? endforeach; ?>
  </ol>
<? endif ?>
