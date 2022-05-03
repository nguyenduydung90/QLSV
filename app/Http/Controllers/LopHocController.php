<?php

namespace App\Http\Controllers;

use App\Http\Requests\LopHocRequest;
use Illuminate\Support\Facades\DB;

use App\Repositories\User\InterFaceUser;
use App\Repositories\LopHoc\InterFaceLopHoc;
use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\User;
use App\Models\Student;
use App\Repositories\Student\InterFaceStudent;

class LopHocController extends Controller
{
    protected $lophoc;
    protected $teacher;
    protected $student;

    public function __construct(InterFaceLopHoc $lophoc, InterFaceUser $teacher, InterFaceStudent $student)
    {
        $this->lophoc = $lophoc;
        $this->teacher = $teacher;
        $this->student = $student;
    }

    public function index()
    {
        $lophocs=User::join('class','class.MAGV','=','users.id')
                        ->select('class.id','class.name', 'users.name AS GVCN', 'class.khoi')
                        ->orderBy('class.khoi', 'asc')
                        ->orderBy('class.name', 'asc')
                        ->get();
        $khois = LopHoc::distinct()->get(['khoi']);
        $lops = LopHoc::distinct()->get(['name']);
        $count = $lophocs->count();
        return view('lophoc.list')
                            ->with('lophocs',$lophocs)
                            ->with('khois',$khois)
                            ->with('lops',$lops)
                            ->with('count',$count);
                        
    }

    public function create()
    {
        $teachers = $this->teacher->getAllUser();
        return view('lophoc.create')->with('teachers',$teachers);

    }

    public function edit($id)
    {
        $teachers = $this->teacher->getAllUser();
        $lophoc = $this->lophoc->findLopHoc($id);
        return view('lophoc.edit')->with('lophoc',$lophoc)
                                    ->with('teachers',$teachers);
    }

    public function detail($id){
        //lay danh sach hoc sinh trong lop hoc
        $data=Lophoc::join('sudent','sudent.MaLH','=','class.id')
                            ->join('users','users.id','=','class.MAGV')
                            ->select('sudent.*','class.id AS idLop','class.name AS lop','class.khoi','users.name AS GVCN')
                            ->where('class.id','=',$id)
                            ->get();
        //lay danh sach hoc sinh khong thuoc lop hoc                    
        $students=Student::where('sudent.MaLH','!=',$id)->get();
              
        $lophoc = $this->lophoc->findLopHoc($id);
        $lophocs=$this->lophoc->getAllLopHoc();

        //lay mang id lop hoc
        $array = json_decode(json_encode($lophocs), True);
        $lophocId=[];
        foreach($array as $v){
            array_push($lophocId,$v['id']);
        }
                                         
        $count=$data->count();
        
        return view('lophoc.detail')->with('data',$data)
                                        ->with('count',$count)
                                        ->with('lophoc',$lophoc)
                                        ->with('lophocs',$lophocs)
                                        ->with('lophocId',$lophocId)
                                        ->with('students',$students);
                                    
    }

    public function store(Request $request)
    {

        $data = [
            'name' => $request->name,
            'MAGV' => $request->MAGV,
            'khoi' => $request->khoi
        ];
        // return response()->json($data);
        try {
            DB::beginTransaction();
            $this->lophoc->insertLopHoc($data);
            DB::commit();
            // $result['status']='success';
            // return response()->json($data);
            return redirect()->route('lophoc.index')->with('success', 'Thêm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getmessage();
        }
    }

    public function update(LopHocRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'MAGV' => $request->MAGV,
            'khoi' => $request->khoi
        ];

        try {
            DB::beginTransaction();
            $this->lophoc->updateLopHoc($id, $data);
            DB::commit();
            return redirect()->route('lophoc.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getmessage();
        }
    }

    public function delete($id)
    {   
        $students=Student::where('MaLH',$id)->get();
        foreach($students as $value){
            $data=[
                'name' => $value->name,
                'image' => $value->image,
                'address' => $value->address,
                'phone' => $value->phone,
                'birthday' => $value->birthday,
                'gender' => $value->gender,
                'MaLH' => 'Chưa phân lớp'
            ];
            $this->student->updateStudent($value->id, $data);;
        }
        $this->lophoc->deleteLopHoc($id);
        return redirect()->route('lophoc.index')->with('success', 'Xóa thành công');
    }

    public function search(Request $request)
    {
        $output = '';
        if ($request->khoi && empty($request->hoten)) {
            $lophocs = LopHoc::join('users', 'users.id', '=', 'class.MAGV')
                ->select('class.*', 'users.name AS GVCN')
                ->where('class.khoi', '=', $request->khoi)
                ->get();
        } elseif (empty($request->khoi) && $request->hoten) {
            $lophocs =  LopHoc::join('users', 'users.id', '=', 'class.MAGV')
                ->select('class.*', 'users.name AS GVCN')
                ->where('users.name', 'LIKE', '%' . $request->hoten . '%')
                ->get();
        } elseif ($request->khoi && $request->hoten) {

            $lophocs =  LopHoc::join('users', 'users.id', '=', 'class.MAGV')
                ->select('class.*', 'users.name AS GVCN')
                ->where('class.khoi', '=', $request->khoi)
                ->where('users.name', 'LIKE', '%' . $request->hoten . '%')
                ->get();
        } else {
            $lophocs =  LopHoc::join('users', 'users.id', '=', 'class.MAGV')
                ->select('class.*', 'users.name AS GVCN', 'class.khoi')
                ->get();
        }
        $count = $lophocs->count();
        if (count($lophocs) > 0) {
            foreach ($lophocs as $key => $lophoc) {
                $output .= '<tr>
                            <td scope="row" >
                                ' . ++$key . '
                            </td>
                            <td class="hidden-phone " >' . $lophoc->khoi . $lophoc->name . '</td>
                            <td class="hidden-phone">' . $lophoc->GVCN . '</td>
                            <td class="text-right">
                            <a href="lophoc/'.$lophoc->id.'/detail" class="btn btn-warning btn-sm">
                            <i class="fa fa-tasks"> Chi tiết</i>
                                </a>
                                <a href="lophoc/' . $lophoc->id . '/edit"
                                    class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                <button type="button" data-toggle="modal" data-target="#myModal' . $lophoc->id . '"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button>
                            </td>
                        </tr>';
            }
            $output .= '<input type="hidden" class="form-control" id="count" value="' . $count . '">';
        } else {
            $output .= '<tr>
                        <td colspan="4" class="text-center">Không có dữ liệu thông tin</td>
                     </tr>';
        }
        return response()->json($output);
    }
}
