@extends('master')
@section('content')
<div class="row mt-3">
    <div class="container" style="width:40%">
       <div class="card">
         <div class="card-body">
         <div class="card-title">Sửa học sinh</div>
         <hr>
          <form action="{{route('student.update',$student->id)}}" method="post" enctype="multipart/form-data">
            @csrf
         <div class="form-group">
          <label for="input-1">Họ và tên</label></label>
          <input type="text" class="form-control" name='name' value="{{$student->name}}" id="input-1" placeholder="Enter Your Name" required>
          <div class="position-relative has-icon-right">
            @if($errors->first('name'))
            <p class="text-danger">{{$errors->first('name')}}</p>
            @endif
           </div>
         </div>
         <div class="form-group">
          <label for="input-1">Ngày sinh</label></label>
          <input type="date" class="form-control" name='birthday' value="{{$student->birthday}}"  id="input-1" placeholder="Enter Your Birthday" required>
          <div class="position-relative has-icon-right">
            @if($errors->first('birthday'))
            <p class="text-danger">{{$errors->first('birthday')}}</p>
            @endif
           </div>
        </div>
         <div class="form-group">
          <label for="input-3">Điện thoại</label>
          <input type="text" class="form-control" name='phone' value="{{$student->phone}}"  id="input-3" placeholder="Enter Your Mobile Number" required>
          <div class="position-relative has-icon-right">
            @if($errors->first('phone'))
            <p class="text-danger">{{$errors->first('phone')}}</p>
            @endif
           </div>
        </div>
         <div class="form-group">
          <label for="input-3">Lớp</label>
            <select name="MaLH" id="" class="form-control" required>
              <option>Chọn lớp học</option>
              @foreach ($lophocs as $key => $l )
                <option value="{{$l->id}}" {{$student->lops->id==$l->id?"selected='seclected'":''}}>{{$l->khoi}}{{$l->name}}</option>
              @endforeach
            </select>
          <div class="position-relative has-icon-right">
            @if($errors->first('MaLH'))
            <p class="text-danger">{{$errors->first('MaLH')}}</p>
            @endif
           </div>
        </div>

         <div class="form-group">
            <label for="gender" >Giới tính</label>
            <select name="gender"  id="gender"  class="form-control" required>
                <option>Chọn giới tính</option>
                <option value="Nam" {{$student->gender=='Nam'?"selected='seclected'":''}}>Nam</option>
                <option value="Nữ"{{$student->gender=='Nữ'?"selected='seclected'":''}}>Nữ</option>
            </select>
            <div class="position-relative has-icon-right">
              @if($errors->first('gender'))
              <p class="text-danger">{{$errors->first('gender')}}</p>
              @endif
             </div>
           </div>
           <div class="form-group">
            <label for="image">Avata</label>
            <input type="file" class="form-control" name='image' id="image" accept=".jpg, .jpeg, .png, .bmp, .gif, .svg" placeholder="Enter Your Avata">
            
            <div class="position-relative has-icon-right">
              @if($errors->first('image'))
              <p class="text-danger">{{$errors->first('image')}}</p>
              @endif
             </div>
          </div>
           <div class="form-group">
            <label for="address">Địa chỉ</label>
            <textarea name="address" class="form-control" value="{{$student->address}}" id="address" cols="10" rows="3"  required>{{$student->address}}</textarea>
            <div class="position-relative has-icon-right">
              @if($errors->first('address'))
              <p class="text-danger">{{$errors->first('address')}}</p>
              @endif
             </div>
          </div>
         <div class="form-group py-2">
           <div class="icheck-material-white">
          <input type="checkbox" id="user-checkbox1" checked=""/>
          <label for="user-checkbox1">I Agree Terms & Conditions</label>
          </div>
         </div>
         <div class="form-group">
          <a  class="btn btn-light px-5 " onclick="history.go(-1)">Quay lại</a>
          <button type="submit" class="btn btn-light px-5 float-right">Lưu</button>
          
        </div>
        </form>
       </div>
       </div>
    </div>
</div>    
@endsection