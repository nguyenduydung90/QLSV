@extends('master')
@section('css')
    <style>
        .group {
            display: flex;
        }

    </style>
@endsection
@section('content')

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Tra cứu học sinh</div>
                    <hr>
                    <form action="{{ route('student.result') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="group">
                            <div class="form-group col-lg-4">
                                <label for="name">Họ và tên</label></label>
                                <input type="text" class="form-control" name='name' id="name"
                                    placeholder="Nhập đầy đủ họ tên" >
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="birth">Ngày sinh</label></label>
                                <input type="date" class="form-control" name='birthday' id="birth"
                                    placeholder="Nhập đầy đủ ngày sinh" >
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('birthday'))
                                        <p class="text-danger">{{ $errors->first('birthday') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="gender" >Giới tính</label>
                                <select name="gender"  id="gender"  class="form-control" >
                                    <option value="">Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                                <div class="position-relative has-icon-right">
                                  @if($errors->first('gender'))
                                  <p class="text-danger">{{$errors->first('gender')}}</p>
                                  @endif
                                 </div>
                               </div>
                        </div>
                        <div class="group">
                            <div class="form-group col-lg-4">
                                <label for="phone">Điện thoại</label>
                                <input type="text" class="form-control" name='phone' id="phone"
                                    placeholder="Nhập số điện thoại">
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name='address' id="address"
                                    placeholder="Nhập địa chỉ">
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="MaLH">Lớp</label>
                                <select name="MaLH" id="MaLH" class="form-control" >
                                    <option value="">Chọn lớp học</option>
                                    @foreach ($lophocs as $key => $l)
                                        <option value="{{ $l->id }}">{{ $l->khoi }}{{ $l->name }}</option>
                                    @endforeach
                                </select>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('MALH'))
                                        <p class="text-danger">{{ $errors->first('MALH') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>




                <div class="form-group py-2">
                    <div class="icheck-material-white">
                        <input type="checkbox" id="user-checkbox1" checked="" />
                        <label for="user-checkbox1">I Agree Terms & Conditions</label>
                    </div>
                </div>
                <div class="form-group">

                    <button type="submit" class="btn btn-light px-5 float-right">Tra cứu</button>

                </div>
                </form>
            </div>
        </div>
    </div>
   
    
@endsection
