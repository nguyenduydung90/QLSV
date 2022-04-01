<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Repositories\LopHoc\InterFaceLopHoc;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Repositories\Student\InterFaceStudent;

class StudentController extends Controller
{
    protected $student;
    protected $lophoc;

    public function __construct(InterFaceStudent $student,InterFaceLopHoc $lophoc)
    {
        $this->student=$student;
        $this->lophoc=$lophoc;
    }

    public function index(Request $request){
        $students=DB::table('sudent')->join('class','class.id','=','sudent.MaLH')
        ->select('sudent.*','class.name AS lop','class.id AS IdLop')
        ->get();

        if($request->keyword){
            $students=DB::table('sudent')->join('class','class.id','=','sudent.MaLH')
                                        ->select('sudent.*','class.name AS lop','class.id AS IdLop')
                                        ->where('sudent.name','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('class.name','LIKE','%'.$request->keyword.'%')
                                        ->get();
        }


        return view('student.list',compact('students'));
    }

    public function create(){
        $lophocs=$this->lophoc->getAllLopHoc();
        return view('student.create',compact('lophocs'));
    }

    public function store(StudentRequest $request){
        $image=$request->file('image');
        $name=time().$image->getClientOriginalName();
        $image->move('uploads/avarta',$name);
         $data= [
            'name' => $request->name,
            'image'=>'uploads/avarta/'.$name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'birthday'=>$request->birthday,
            'gender'=>$request->gender,
            'MaLH'=>$request->MALH
        ];
            try{
                DB::beginTransaction();
                $this->student->insertStudent($data);
                DB::commit();
                return redirect()->route('student.index')->with('success','Đăng ký thành công');
            }catch(\Exception $e){
                DB::rollBack();
               return $e->getmessage();
            }
    }

    public function update(StudentRequest $request,$id){
        $image=$request->file('image');
        $name=time().$image->getClientOriginalName();
        $image->move('uploads/avarta',$name);
         $data= [
            'name' => $request->name,
            'image'=>'uploads/avarta/'.$name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'birthday'=>$request->birthday,
            'gender'=>$request->gender,
            'MALH'=>$request->MALH
        ];
            try{
                DB::beginTransaction();
                $this->student->updateStudent($id,$data);
                DB::commit();
                return redirect()->route('student.index')->with('success','Cập nhật thành công');
            }catch(\Exception $e){
                DB::rollBack();
               return $e->getmessage();
            }
    }

    public function delete($id){
        $this->student->deleteStudent($id);
        return redirect()->route('student.index')->with('success','Xóa thành công');
    }
}
