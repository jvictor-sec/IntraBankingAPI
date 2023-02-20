<?php
  namespace App\Models;

  class Finance {
    private static $finance_table = "finance_table";
    private static $user_table = "user_table";

    public function insert($data) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $user_check_command = "SELECT user_id FROM ".self::$user_table." WHERE user_id = :fk_user";

      $user_check_stmt = $pdo_connection->prepare($user_check_command);

      $user_check_stmt->bindValue(":fk_user", $data["fk_user"]);

      $user_check_stmt->execute();

      if($user_check_stmt->rowCount() > 0) {
        $insert_command = "INSERT INTO ".self::$finance_table." VALUES(0, :finance_name, :finance_description, :finance_price, :finance_date, :finance_recipient, :fk_user)";

        $insert_stmt = $pdo_connection->prepare($insert_command);

        $insert_stmt->bindValue(":finance_name", $data["finance_name"]);
        $insert_stmt->bindValue(":finance_description", $data["finance_description"]);
        $insert_stmt->bindValue(":finance_price", $data["finance_price"]);
        $insert_stmt->bindValue(":finance_date", $data["finance_date"]);
        $insert_stmt->bindValue(":finance_recipient", $data["finance_recipient"]);
        $insert_stmt->bindValue(":fk_user", $data["fk_user"]);

        $insert_stmt->execute();

        if($insert_stmt->rowCount() > 0) {
          return "Finança cadastrada com sucesso!";
        } else {
          throw new \Exception("Ocorreu um erro durante o cadastro. Cheque os campos do formulário.");
        }
      } else {

        throw new \Exception("Ocorreu um erro durante o cadastro. Verifique se as credenciais de usuário estão corretas.");
      }

      $pdo_connection = null;

    }

    public static function select_all($fk_user) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $user_check_command = "SELECT user_id FROM ".self::$user_table." WHERE user_id = :fk_user";

      $user_check_stmt = $pdo_connection->prepare($user_check_command);

      $user_check_stmt->bindValue(":fk_user", $fk_user);

      $user_check_stmt->execute();

      if($user_check_stmt->rowCount() > 0) {
        $select_all_command = "SELECT * FROM ".self::$finance_table." WHERE fk_user = :fk_user";

        $select_all_stmt = $pdo_connection->prepare($select_all_command);

        $select_all_stmt->bindValue(":fk_user", $fk_user);

        $select_all_stmt->execute();

        if($select_all_stmt->rowCount() > 0) {
          return $select_all_stmt->fetchAll(\PDO::FETCH_OBJ);
        } else {
          throw new \Exception("Ocorreu um erro durante a listagem. O usuário ao qual as finanças estão sendo listadas não possui nenhuma finança cadastrada.");
        }
      } else {
        throw new \Exception("Ocorreu um erro durante a listagem. O usuário ao qual as finanças estão sendo listadas não existe.");
      }

      $pdo_connection = null;
    }

    public function update($data) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $user_check_command = "SELECT user_id FROM ".self::$user_table." WHERE user_id = :fk_user";

      $user_check_stmt = $pdo_connection->prepare($user_check_command);

      $user_check_stmt->bindValue(":fk_user", $data["update_fk_user"]);

      $user_check_stmt->execute();

      if($user_check_stmt->rowCount() > 0) {
        $update_command = "UPDATE ".self::$finance_table." SET finance_name = :finance_name, finance_description = :finance_description, finance_price = :finance_price,
                                                           finance_date = :finance_date, finance_recipient = :finance_recipient WHERE finance_id = :finance_id";

        $update_stmt = $pdo_connection->prepare($update_command);

        $update_stmt->bindValue(":finance_name", $data["finance_name"]);
        $update_stmt->bindValue(":finance_description", $data["finance_description"]);
        $update_stmt->bindValue(":finance_price", $data["finance_price"]);
        $update_stmt->bindValue(":finance_date", $data["finance_date"]);
        $update_stmt->bindValue(":finance_recipient", $data["finance_recipient"]);
        $update_stmt->bindValue(":finance_id", $data["finance_id"]);

        $update_stmt->execute();

        if($update_stmt->rowCount() > 0) {
            return "Finança atualizada com sucesso.";
        } else {
          throw new \Exception("Ocorreu um erro durante a edição.");
        }
      } else {
        throw new \Exception("Ocorreu um erro durante a edição. O usuário ao qual você está tentando editar as finanças não existe.");
      }

      $pdo_connection = null;
    }

    public function delete($data) {
      $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

      $delete_command = "DELETE FROM ".self::$finance_table." WHERE finance_id = :finance_id";

      $delete_stmt = $pdo_connection->prepare($delete_command);

      $delete_stmt->bindValue(":finance_id", $data["finance_id"]);

      $delete_stmt->execute();

      if($delete_stmt->rowCount() > 0) {
        return "Finança excluída com sucesso.";
      } else {
        throw new \Exception("Ocorreu um erro durante a exclusão.");
      }

      $pdo_connection = null;
    }
  }
?>
