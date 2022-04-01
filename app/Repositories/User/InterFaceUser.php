<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;

interface InterFaceUser {

    /**
     * Call api login
     * @param string $email email user
     * @param string $password password user
     * @return \Illuminate\Http\Response
     */

     public function getAllUser ();
     public function insertUser (array $params);
     public function updateUser (int $id, array $params);
     public function deleteUser (int $id);
     public function findUser(int $id);
}
