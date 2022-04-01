<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class StudentRepository extends BaseRepository implements InterFaceStudent
{
    public function getModel()
    {
        return Student::class;
    }


    public function getAllStudent (){
        // return $this->model->get();
        return $this->getAll();
    }

    public function insertStudent(array $parameters){
        try{
           return $this->create($parameters);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function updateStudent (int $id, array $parameters){
        try{
         return  $this->update($id,$parameters);

        }catch(\Exception $e){
            return response()->json(['statuts'=> 400,'message'=>'Lỗi, Cập nhật tài khoản thất bại!']);
        }
    }

    public function deleteStudent ($id) {

        try{
           return $this->delete($id);

        }catch(\Exception $e){
            return response()->json(['statuts'=>400,'message'=>'Lỗi, chưa xóa tài khoản']);

        }
    }

    public function findStudent($id){
        return $this->find($id);
    }

}












