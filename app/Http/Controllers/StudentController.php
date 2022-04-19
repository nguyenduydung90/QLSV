<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Repositories\LopHoc\InterFaceLopHoc;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Repositories\Student\InterFaceStudent;


class StudentController extends Controller
{
    protected $student;
    protected $lophoc;

    public function __construct(InterFaceStudent $student, InterFaceLopHoc $lophoc)
    {
        $this->student = $student;
        $this->lophoc = $lophoc;
    }

    public function index(Request $request)
    {

        $lophocs = DB::table('class')->get();
        $students = DB::table('sudent')->join('class', 'class.id', '=', 'sudent.MaLH')
            ->select('sudent.*', 'class.name AS lop', 'class.id AS IdLop', 'class.khoi')
            ->orderBy('class.khoi', 'asc')
            ->orderBy('class.name', 'asc')
            ->get();
        $count = $students->count();
        return view('student.list', compact('students', 'lophocs', 'count'))->with('namepage', 'addStudent');
    }

    public function create()
    {
        $lophocs = $this->lophoc->getAllLopHoc();
        return view('student.create', compact('lophocs'));
    }

    public function edit($id)
    {
        
        $student = $this->student->findStudent($id);
        $lophocs = $this->lophoc->getAllLopHoc();

        return view('student.edit', compact('student', 'lophocs'));
       
    }

    public function store(StudentRequest $request)
    {

        $id_lh = $request->id_lh;
        if ($request->file('image')) {
            $image = $request->file('image');
            $name = time() . $image->getClientOriginalName();
            $image->move('uploads/avarta', $name);
            $img = 'uploads/avarta/' . $name;
        } else {
            $img = 'Css/assets/images/dafault.jpg';
        }

        $data = [
            'name' => $request->name,
            'image' => $img,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'MaLH' => $request->MaLH
        ];
        try {
            DB::beginTransaction();
            $this->student->insertStudent($data);
            DB::commit();
            if ($id_lh) {
                return redirect()->route('lophoc.detail',$id_lh);
            }
            return redirect()->route('student.index')->with('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getmessage();
        }
    }

    public function update(Request $request, $id)
    {
        
        $student = $this->student->findStudent($id);
        $img = $request->file('image');
        if ($request->file('image')) {
            $image = $request->file('image');
            $name = time() . $image->getClientOriginalName();
            $image->move('uploads/avarta', $name);
        }
        $idDetail=$request->MaLH;
        $data = [
            'name' => $request->name,
            'image' => $img ? 'uploads/avarta/' . $name : $student->image,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'MaLH' => $request->MaLH
        ];
        
        try {
            DB::beginTransaction();
            $this->student->updateStudent($id, $data);
            DB::commit();
            if($request->id_lh == 'listStudentInlop'){
                return redirect('lophoc/'.$idDetail.'/detail');
            }else{
                return redirect()->route('student.index')->with('success', 'Cập nhật thành công');
            }
            

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getmessage();
        }
    }

    public function delete(Request $request,$id)
    {
        $idLop=$request->idLop;
        $this->student->deleteStudent($id);
        
            
        if($request->namepage == 'listDetailClass'){

            return redirect('lophoc/'.$idLop.'/detail');
        }else{
            return redirect()->route('student.index');
        }
        

    }

    public function showViewSearch(){
        $lophocs = $this->lophoc->getAllLopHoc();
        return view('student.viewSearch')->with('lophocs',$lophocs);
                                            
    }
    public function resultSearch(Request $request)
    {
        $input=$request->all();

        $students=Student::join('class','class.id','=','sudent.MaLH')
                            ->select('sudent.*','class.name AS lop','class.khoi')
                            ->get();
              
        if($input['name'] != ''){$students=$students->where('name',$input['name']);}
        if($input['birthday'] != ''){$students=$students->where('birthday',$input['birthday']);}
        if($input['gender'] != ''){$students=$students->where('gender','=',$input['gender']);}
        if($input['phone'] != ''){$students=$students->where('phone',$input['phone']);}
        if($input['address'] != ''){$students=$students->where('address',$input['address']);}
        if($input['MaLH'] != ''){$students=$students->where('MaLH','=',$input['MaLH']);}

        $soluong = $students->count();
        return view('student.resultSearch')->with('students',$students)
                                            ->with('pageTitle','Tra cứu');
    }
}
