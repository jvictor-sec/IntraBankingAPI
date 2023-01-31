<?php
  namespace App\Models;

  class User {
    private static $user_table = "user_table";

    public function insert($data) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
      // Code...
      $pdo_connection = null;
    }

    public static function select($id) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $select_all_command = "SELECT * FROM ".self::$user_table." WHERE user_id = :user_id";

      $select_all_stmt = $pdo_connection->prepare($select_all_command);

      $select_all_stmt->bindValue(":user_id", $id);

      $select_all_stmt->execute();

      if($select_all_stmt->rowCount() > 0) {
        return $select_all_stmt->fetch(\PDO::FETCH_ASSOC);
      } else {
        throw new \Exception("Ocorreu um erro durante a listagem.");
      }

      $pdo_connection = null;
    }

    public static function select_all() {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $select_all_command = "SELECT * FROM ".self::$user_table;

      $select_all_stmt = $pdo_connection->query($select_all_command);

      if($select_all_stmt->rowCount() > 0) {
        return $select_all_stmt->fetchAll(\PDO::FETCH_OBJ);
      } else {
        throw new \Exception("Ocorreu um erro durante a listagem.");
      }

      $pdo_connection = null;
    }

    public function update($data) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
      // Code...
      $pdo_connection = null;
    }

    public function delete($data) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
      // Code...
      $pdo_connection = null;
    }
  }
?>
