<?php
  namespace App\Controllers;

  use App\Models\User;

  class UserController {
    public function post() {
      if($_POST["login_controller"]) {
        return User::login($_POST);
      } else {
        return User::insert($_POST);
      }
    }

    public function get($user_email = null) {
      return User::select($user_email);
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
