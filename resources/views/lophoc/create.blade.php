@extends('master')
@section('content')
<div class="row mt-3">
    <div class="container" style="width:40%">
       <div class="card">
         <div class="card-body">
         <div class="card-title">Thêm Lớp Học</div>
         <hr>
          <form action="{{route('lophoc.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="khoi">Khối</label></label>
              <input type="text" class="form-control" name='khoi'  id="khoi" placeholder="Nhập khối lớp" required>
              <div class="position-relative has-icon-right">
                @if($errors->first('name'))
                <p class="text-danger">{{$errors->first('name')}}</p>
                @endif
               </div>
             </div>
         <div class="form-group">
          <label for="name" >Lớp</label>
          <select name="name" id=""  class="form-control" required>
              <option value="">--Chọn Lớp--</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
          </select>
          <div class="position-relative has-icon-right">
            @if($errors->first('name'))
            <p class="text-danger">{{$errors->first('name')}}</p>
            @endif
           </div>
         </div>

         <div class="form-group">
            <label for="input-3" >Giáo viên chủ nhiệm</label>
            <select name="MAGV" id=""  class="form-control" required>
                <option>Chọn GVCN</option>
                @foreach ($teachers as $key=>$t )
                <option value="{{$t->id}}">{{$t->name}}</option>
                @endforeach
  
            </select>
            <div class="position-relative has-icon-right">
              @if($errors->first('MAGV'))
              <p class="text-danger">{{$errors->first('MAGV')}}</p>
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
          <a href="{{route('lophoc.index')}}" class="btn btn-light px-5 ">Quay lại</a>
          <button type="submit" class="btn btn-light px-5 float-right">Lưu</button>
          
        </div>
        </form>
       </div>
       </div>
    </div>
</div>    
@endsection