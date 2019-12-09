<?php
namespace app\components\db;

class Mysql
{
  const HOST = '127.0.0.1';
  const PORT = 3306;
  const USER = 'root';
  const PASS = '';
  const DBNAME = 'blog';
  const CHARSET = 'utf8';

  private static $instance;

  public static function getPDO() : \PDO
  {
    if (null === static::$instance) {
      $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=%s',
        static::HOST,
        static::PORT,
        static::DBNAME,
        static::CHARSET
      );

      static::$instance = new \PDO(
        $dsn,
        static::USER,
        static::PASS,
        [
          \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]
      );
    }

    return static::$instance;
  }
}