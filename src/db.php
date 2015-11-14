<?php
class DB{
  public static function connection(){
    try {

      $connection = new PDO('pgsql:');
      $connection->exec('SET NAMES UTF8');
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    } catch (PDOException $e) {
      die('Virhe tietokantayhteydessä tai tietokantakyselyssä: ' . $e->getMessage());
    }
    return $connection;
  }
}
