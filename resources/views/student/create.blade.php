@extends('master')
@section('content')
<div class="row mt-3">
    <div class="container" style="width:50%">
       <div class="card">
         <div class="card-body">
         <div class="card-title">Thêm sinh viên</div>
         <hr>
          <form action="{{route('student.store')}}" method="post" enctype="multipart/form-data">
            @csrf
         <div class="form-group">
          <label for="input-1">Họ và tên</label></label>
          <input type="text" class="form-control" name='name' id="input-1" placeholder="Enter Your Name">
          <div class="position-relative has-icon-right">
            @if($errors->first('name'))
            <p class="text-danger">{{$errors->first('name')}}</p>
            @endif
           </div>
         </div>
         <div class="form-group">
          <label for="input-1">Ngày sinh</label></label>
          <input type="date" class="form-control" name='birthday'  id="input-1" placeholder="Enter Your Birthday">
          <div class="position-relative has-icon-right">
            @if($errors->first('birthday'))
            <p class="text-danger">{{$errors->first('birthday')}}</p>
            @endif
           </div>
        </div>
         <div class="form-group">
          <label for="input-3">Điện thoại</label>
          <input type="text" class="form-control" name='phone'  id="input-3" placeholder="Enter Your Mobile Number">
          <div class="position-relative has-icon-right">
            @if($errors->first('phone'))
            <p class="text-danger">{{$errors->first('phone')}}</p>
            @endif
           </div>
        </div>
         <div class="form-group">
          <label for="input-3">Lớp</label>
            <select name="MALH" id="" class="form-control">
              <option>Chọn lớp học</option>
              @foreach ($lophocs as $key => $l )
                <option value="{{$l->id}}">{{$l->name}}</option>
              @endforeach
            </select>
          <div class="position-relative has-icon-right">
            @if($errors->first('MALH'))
            <p class="text-danger">{{$errors->first('MALH')}}</p>
            @endif
           </div>
        </div>

         <div class="form-group">
            <label for="input-3" >Giới tính</label>
            <select name="gender"  id=""  class="form-control">
                <option>Chọn giới tính</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
            <div class="position-relative has-icon-right">
              @if($errors->first('gender'))
              <p class="text-danger">{{$errors->first('gender')}}</p>
              @endif
             </div>
           </div>
           <div class="form-group">
            <label for="input-5">Avata</label>
            <input type="file" class="form-control" name='image' id="input-5" placeholder="Enter Your Avata">
            
            <div class="position-relative has-icon-right">
              @if($errors->first('image'))
              <p class="text-danger">{{$errors->first('image')}}</p>
              @endif
             </div>
          </div>
           <div class="form-group">
            <label for="input-5">Địa chỉ</label>
            <textarea name="address" class="form-control" id="" cols="10" rows="3"></textarea>
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
          <a href="{{route('student.index')}}" class="btn btn-light px-5 ">Quay lại</a>
          <button type="submit" class="btn btn-light px-5 float-right">Lưu</button>
          
        </div>
        </form>
       </div>
       </div>
    </div>
</div>    
@endsection