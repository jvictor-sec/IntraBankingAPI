<?php
  namespace App\Controllers;

  use App\Models\User;

  class UserController {
    public function post() {
      return User::insert($_POST);
    }

    public function get(int $id = null) {
      if($id) {
        return User::select($id);
      } else {
        return User::select_all();
      }
    }

    public function put() {
      $_PUT = json_decode(file_get_contents("php://input"), true);

      return User::update($_PUT);
    }

    public function delete() {
      $_DELETE = json_decode(file_get_contents("php://input"), true);

      return User::delete($_DELETE);
    }
  }
?>
