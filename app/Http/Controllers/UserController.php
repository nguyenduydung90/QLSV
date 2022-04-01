<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\User\InterFaceUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    protected $user;

    public function __construct(InterFaceUser $user)
    {
        $this->user = $user;
    }
    public function showFormRegister(){
        return view('login.register');
    } 

    public function showListUser(Request $request){
        $users=DB::table('users')->select('*')->get();
        if  ($request->keyword){
            $users=DB::table('users')->select('*')
                                        ->where('name','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('address','LIKE','%'.$request->keyword.'%')
                                        ->orWhere('email','LIKE','%'.$request->keyword.'%')
                                        ->get();
        }
        return view('user.list',compact('users'));
    }

    public function create(){
        return view('user.create');
    }

    public function edit($id){
        $user=$this->user->findUser($id);
        return view('user.edit',compact('user'));

    }
    
    public function register(UserRequest $request){
        $password= Hash::make($request->password);
        $image=$request->file('image');
        $name=time().$image->getClientOriginalName();
        $image->move('uploads/avarta',$name);
         $data= [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$password,
            'image'=>'uploads/avarta/'.$name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'birthday'=>$request->birthday,
            'gender'=>$request->gender
        ];

            try{
                DB::beginTransaction();
                $this->user->insertUser($data);
                DB::commit();
                return redirect()->route('user.listUser')->with('success','Đăng ký thành công');
            }catch(\Exception $e){
                DB::rollBack();
               return $e->getmessage();
            }
    }

    public function update(UserRequest $request,$id){
        $password= Hash::make($request->password);
        $image=$request->file('image');
        $name=time().$image->getClientOriginalName();
        $image->move('uploads/avarta',$name);
         $data= [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$password,
            'image'=>'uploads/avarta/'.$name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'birthday'=>$request->birthday,
            'gender'=>$request->gender
        ];
            try{
                DB::beginTransaction();
                $this->user->updateUser($id,$data);
                DB::commit();
                return redirect()->route('user.listUser')->with('success','Cập nhật thành công');
            }catch(\Exception $e){
                DB::rollBack();
               return $e->getmessage();
            }
    
    }

    public function delete($id){
        $this->user->deleteUser($id);
        return redirect()->route('user.listUser')->with('success','Xóa thành công');
    }

}
