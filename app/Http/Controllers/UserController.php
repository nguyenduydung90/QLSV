<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\User\InterFaceUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    protected $user;

    public function __construct(InterFaceUser $user)
    {
        $this->user = $user;
    }
    public function showFormRegister()
    {
        return view('login.register');
    }

    public function showListUser(Request $request)
    {
        $users = DB::table('users')->select('*')->get();
        if ($request->keyword) {
            $users = DB::table('users')->select('*')
                ->where('name', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('address', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $request->keyword . '%')
                ->get();
        }
        $count = $users->count();
        return view('user.list', compact('users', 'count'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function edit($id)
    {
        $user = $this->user->findUser($id);
        return view('user.edit', compact('user'));
    }

    public function register(UserRequest $request)
    {
        $password = Hash::make($request->password);
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
            'email' => $request->email,
            'password' => $password,
            'image' => $img,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender
        ];

        try {
            DB::beginTransaction();
            //User::create($data);
            $this->user->insertUser($data);
            DB::commit();
            return redirect()->route('user.listUser')->with('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getmessage();
        }
    }

    public function update(UserRequest $request, $id)
    {
        $password = Hash::make($request->password);
        $user = $this->user->findUser($id);
        $img = $request->file('image');
        $defaulImg = 'Css/assets/images/dafault.jpg';
        if ($request->file('image')) {
            if($request->file('image') != $defaulImg){
                File::Delete($user->image);
            };
            $image = $request->file('image');
            $name = time() . $image->getClientOriginalName();
            $image->move('uploads/avarta', $name);
        };

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'image' => $img ? 'uploads/avarta/' . $name : $user->image,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender
        ];
        try {
            DB::beginTransaction();
            $this->user->updateUser($id, $data);
            DB::commit();
            return redirect()->route('user.listUser')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getmessage();
        }
    }

    public function delete($id)
    {
        $this->user->deleteUser($id);
        return redirect()->route('user.listUser')->with('success', 'Xóa thành công');
    }

    public function search(Request $request)
    {
        $output = '';
        $users = DB::table('users')->select('*')
            ->where('name', 'LIKE', '%' . $request->keyword . '%')
            ->orWhere('address', 'LIKE', '%' . $request->keyword . '%')
            ->orWhere('email', 'LIKE', '%' . $request->keyword . '%')
            ->get();


        if (count($users) > 0) {
            foreach ($users as $key => $user) {
                $output .= '<tr>
                <td scope="row">
                    ' . ++$key . '
                </td>
                <td class="hidden-phone"><img src="' . $user->image . '" alt="" style="width: 50px; height: 50px"></td>
                <td class="hidden-phone text-left" >' . $user->name . '</td>
                <td class="hidden-phone">' . $user->address . '</td>
                <td class="hidden-phone">' . $user->email . '</td>
                <td class="hidden-phone">' . $user->phone . '</td>
                <td>
                    <a href="/user/' . $user->id . '/editUser"
                        class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                    <button type="button" data-toggle="modal" data-target="#myModal' . $user->id . '"
                        class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button>
                </td>
            </tr>';
            }
        } else {
            $output .= '<tr>
            <td colspan="7" class="text-center">Không có dữ liệu thông tin</td>
                    </tr>';
        }

        return response()->json($output);
    }
}
