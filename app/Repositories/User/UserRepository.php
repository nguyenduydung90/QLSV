<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements InterFaceUser
{
    public function getModel()
    {
        return User::class;
    }


    public function getAllUser (){
        // return $this->model->get();
        return $this->getAll();
    }

    public function insertUser(array $parameters){
        try{
           return $this->create($parameters);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function updateUser (int $id, array $parameters){
        try{
         return  $this->update($id,$parameters);

        }catch(\Exception $e){
            return response()->json(['statuts'=> 400,'message'=>'Lỗi, Cập nhật tài khoản thất bại!']);
        }
    }

    public function deleteUser ($id) {

        try{
           return $this->delete($id);

        }catch(\Exception $e){
            return response()->json(['statuts'=>400,'message'=>'Lỗi, chưa xóa tài khoản']);

        }
    }

    public function findUser($id){
        return $this->find($id);
    }

}












