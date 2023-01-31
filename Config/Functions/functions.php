<?php

  function unique_field_verifier($field_table, $field_name, $field_data, $id_name, $id_data, $update_controller) {
    $pdo_connection = new \PDO(DB_DRIVE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

    $unique_verifier_command = "SELECT * FROM ".$field_table." WHERE ".$field_name." = :".$field_name;

    if($id_name && $update_controller) {
      $unique_verifier_command .= " AND ".$id_name." != :".$id_name;

      $unique_verifier_stmt = $pdo_connection->prepare($unique_verifier_command);

      $unique_verifier_stmt->bindValue(":".$field_name, $field_data);
      $unique_verifier_stmt->bindValue(":".$id_name, $id_data);

      $unique_verifier_stmt->execute();
    } else {
      $unique_verifier_stmt = $pdo_connection->prepare($unique_verifier_command);
      $unique_verifier_stmt->bindValue(":".$field_name, $field_data);

      $unique_verifier_stmt->execute();
    }

    $pdo_connection = null;

    return $unique_verifier_stmt->rowCount();
  }
?>
