<?php

namespace App\Repositories\LopHoc;

use App\Models\LopHoc;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Http;



class LopHocRepository extends BaseRepository implements InterFaceLopHoc
{
    public function getModel()
    {
        return LopHoc::class;
    }


    public function getAllLopHoc (){
        // return $this->model->get();
        return $this->getAll();
    }

    public function insertLopHoc(array $parameters){
        try{
           return $this->create($parameters);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


    public function updateLopHoc (int $id, array $parameters){
        try{
         return  $this->update($id,$parameters);

        }catch(\Exception $e){
            return response()->json(['statuts'=> 400,'message'=>'Lỗi, Cập nhật tài khoản thất bại!']);
        }
    }

    public function deleteLopHoc ($id) {

        try{
           return $this->delete($id);

        }catch(\Exception $e){
            return response()->json(['statuts'=>400,'message'=>'Lỗi, chưa xóa tài khoản']);

        }
    }

    public function findLopHoc($id){
        return $this->find($id);
    }



}












