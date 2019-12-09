<?php
namespace app\components\helper;

class Entry
{
  public static function formatDate(\DateTime $date) : string
  {
    if ($date->format('Y-m-d') == date('Y-m-d')) {
      return 'Today';
    }

    return $date->format('d.m.Y');
  }

  public static function prepareText(string $text, \app\models\Entry $entry) : string
  {
    $maxLength = 1000;
    $textPrepared = $text;

    if (mb_strlen($textPrepared) > $maxLength) {
      $textPrepared = mb_substr($textPrepared, 0, $maxLength) . '...';
    }

    $textPrepared .= sprintf(
      '&nbsp;<a href="/entry/view?id=%d">read more</a>',
      $entry->getId()
    );

    return $textPrepared;
  }
}