<?php
  namespace App\Models;

  class User {
    private static $user_table = "user_table";

    public function insert($data) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $email_check = unique_field_verifier(self::$user_table, "user_email", $data["user_email"], null, null, null);

      if($email_check == 0) {
        $insert_command = "INSERT INTO ".self::$user_table." VALUES(0, :user_name, :user_email, :user_ddd, :user_number, :user_password)";

        $insert_stmt = $pdo_connection->prepare($insert_command);

        // Validação do número de celular
        $user_phone_number = explode(" ", $data["user_phone_number"]);

        $user_ddd = substr(substr($user_phone_number[0], 0, -1), 1);
        $user_number = implode("", explode("-", $user_phone_number[1]));

        $insert_stmt->bindValue(":user_name", $data["user_name"]);
        $insert_stmt->bindValue(":user_email", $data["user_email"]);
        $insert_stmt->bindValue(":user_ddd", $user_ddd);
        $insert_stmt->bindValue(":user_number", $user_number);
        $insert_stmt->bindValue(":user_password", md5($data["user_password"]));

        $insert_stmt->execute();

        if($insert_stmt->rowCount() > 0) {
          return "Usuário cadastrado com sucesso!";
        } else {
          throw new \Exception("Ocorreu um erro durante o cadastro. Cheque os campos do formulário.");
        }
      } else {
        throw new \Exception("Ocorreu um erro durante o cadastro. O email em questão já está em uso.");
      }

      $pdo_connection = null;
    }

    public static function login($data) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $email_check_command = "SELECT user_id FROM ".self::$user_table." WHERE user_email = :user_email";

      $email_check_stmt = $pdo_connection->prepare($email_check_command);

      $email_check_stmt->bindValue(":user_email", $data["user_email"]);

      $email_check_stmt->execute();

      if($email_check_stmt->rowCount() == 1) {
        $password_check_command = "SELECT user_password FROM ".self::$user_table." WHERE user_id = :user_id AND user_password = :user_password";

        $password_check_stmt = $pdo_connection->prepare($password_check_command);

        $user_id = $email_check_stmt->fetch(\PDO::FETCH_OBJ);

        $password_check_stmt->bindValue(":user_password", md5($data["user_password"]));
        $password_check_stmt->bindValue(":user_id", $user_id->user_id);

        $password_check_stmt->execute();

        if($password_check_stmt->rowCount() == 1) {
            return "Login realizado com sucesso";
        } else {
          throw new \Exception("Email e/ou senha incorretos");
        }
      } else {
        throw new \Exception("Email e/ou senha incorretos");
      }
    }

    public static function select($user_email) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $select_all_command = "SELECT * FROM ".self::$user_table." WHERE user_email = :user_email";

      $select_all_stmt = $pdo_connection->prepare($select_all_command);

      $select_all_stmt->bindValue(":user_email", $user_email);

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
