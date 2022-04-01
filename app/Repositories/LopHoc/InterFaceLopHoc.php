<?php

namespace App\Repositories\LopHoc;

use Illuminate\Http\Request;

interface InterFaceLopHoc {

    /**
     * Call api login
     * @param string $email email user
     * @param string $password password user
     * @return \Illuminate\Http\Response
     */

     public function getAllLopHoc ();
     public function insertLopHoc (array $params);
     public function updateLopHoc (int $id, array $params);
     public function deleteLopHoc (int $id);
     public function findLopHoc(int $id);
     public function getAllByCondition(int $params);
}
