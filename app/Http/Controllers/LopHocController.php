<?php

namespace App\Http\Controllers;

use App\Http\Requests\LopHocRequest;
use Illuminate\Support\Facades\DB;

use App\Repositories\User\InterFaceUser;
use App\Repositories\LopHoc\InterFaceLopHoc;
use Illuminate\Http\Request;

class LopHocController extends Controller
{
    protected $lophoc;
    protected $teacher;

    public function __construct(InterFaceLopHoc $lophoc,InterFaceUser $teacher)
    {
        $this->lophoc=$lophoc;
        $this->teacher=$teacher;
    }

    public function index(Request $request){
        $lophocs=DB::table('users')->join('class','class.MAGV','=','users.id')
                                    ->select('class.*','users.name AS GVCN')
                                    ->get();
                                   
        if($request->keyword){          
            $lophocs=DB::table('class')->join('users','users.id','=','class.MAGV')
                                        ->select('class.*','users.name AS GVCN')
                                        ->where('class.name','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('users.name','LIKE','%'.$request->keyword.'%')
                                        ->get();                                            
        }       
        return view('lophoc.list',compact('lophocs'));
    }

    public function create(){
        $teachers=$this->teacher->getAllUser();
        return view('lophoc.create',compact('teachers'));
    }

    public function edit($id){
        $teachers=$this->teacher->getAllUser();
        $lophoc=$this->lophoc->findLopHoc($id);
        return view('lophoc.edit',compact('lophoc','teachers'));
    }

    public function store(LopHocRequest $request){

         $data= [
            'name' => $request->name,
            'MAGV'=>$request->MAGV
        ];
            try{
                DB::beginTransaction();
                $this->lophoc->insertLopHoc($data);
                DB::commit();
                return redirect()->route('lophoc.index')->with('success','Thêm thành công');
            }catch(\Exception $e){
                DB::rollBack();
               return $e->getmessage();
            }
    }

    public function update(LopHocRequest $request,$id){
        $data= [
            'name' => $request->name,
            'MAGV'=>$request->MAGV
        ];
            try{
                DB::beginTransaction();
                $this->lophoc->updateLopHoc($id,$data);
                DB::commit();
                return redirect()->route('lophoc.index')->with('success','Cập nhật thành công');
            }catch(\Exception $e){
                DB::rollBack();
               return $e->getmessage();
            }
    }

    public function delete($id){
        $this->lophoc->deleteLopHoc($id);
        return redirect()->route('lophoc.index')->with('success','Xóa thành công');
    }
}
