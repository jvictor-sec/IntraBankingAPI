<?php
  namespace App\Controllers;

  use App\Models\Finance;

  class FinanceController {
    public function post() {
      return Finance::insert($_POST);
    }

    public function get(int $fk_user) {
      return Finance::select_all($fk_user);
    }

    public function put() {
      $_PUT = json_decode(file_get_contents("php://input"), true);

      return Finance::update($_PUT);
    }

    public function delete() {
      $_DELETE = json_decode(file_get_contents("php://input"), true);

      return Finance::delete($_DELETE);
    }
  }
?>
