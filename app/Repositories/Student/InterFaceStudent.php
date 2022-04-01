<?php

namespace App\Repositories\Student;

use Illuminate\Http\Request;

interface InterFaceStudent {

    /**
     * Call api login
     * @param string $email email user
     * @param string $password password user
     * @return \Illuminate\Http\Response
     */

     public function getAllStudent ();
     public function insertStudent (array $params);
     public function updateStudent (int $id, array $params);
     public function deleteStudent (int $id);
     public function findStudent(int $id);
}
