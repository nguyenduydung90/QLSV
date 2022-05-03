@extends('master')
@section('css')
    <style>
        .sm {
            width: 60%;
            margin-right: 5px;
        }

        .form-group {
            margin-right: 20px;
        }

        .btn-search {
            float: right;
        }

        .card .table td {
            line-height: 52px;
        }

        .title {
            width: 50%;
            float: left;
            text-align: left;
        }

        .btn-add {
            width: 50%;
            float: right;

        }

        /* .btn-choose-class {
            width: 30%;
            float: left;
            margin-left: 141px
        } */

        /* .btn-choose-hoten {
            width: 30%;
            float: left;
        } */

        .count-student {
            width: 30%;
            float: left;
        }

        .group {
            display: flex;
        }
        .form-group {
            margin-right: 9px;
        }
        .siso{
            float: left;
            line-height: 40px;
            margin-left: 37px;
        }
        #soluong{
            float: left;
            background: none
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="group">
                <div class="title">
                    <h5 class="card-title mt-3 ml-3 ">Danh sách học sinh / {{$pageTitle}}</h5>
                </div>
                <div class="btn-add ">
                    <a href="{{route('student.viewSearch')}}" class='btn btn-info mt-3 float-right mr-3 '><i class="fa fa-backward"></i> Quay lại tra cứu</a>
                </div>

            </div>
            <div class="group">
                <div class="count-student ">
                    <label for="hoten" class='siso'>Sĩ số: </label>
                    <input type="text" class="form-control" id="soluong" value="{{ $count }}" style="width: 45px"
                        disabled>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">Giới tính</th>
                                <th scope="col">Lớp</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col " style="text-align: right; padding-right: 41px;">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody id='listStudent'>

                            @if ($count == 0)
                                <tr>
                                    <td colspan="7" class="text-center">Không có dữ liệu thông tin cần tìm</td>
                                </tr>
                            @else
                                @foreach ($students as $key => $student)
                                    <tr>
                                        <td scope="row">
                                            {{ ++$key }}
                                        </td>
                                        <td class="hidden-phone"><img src="{{ asset($student->image) }}" alt=""
                                                style="width: 60px; height: 50px"></td>

                                        <td class="hidden-phone text-left">{{ $student->name }}</td>
                                        <td class="hidden-phone text-left">{{ $student->gender }}</td>
                                        <td class="hidden-phone text-left">
                                            @if (in_array($student->MaLH,$lophoc))
                                            @foreach ($lophocs as $l )
                                            @if ($student->MaLH == $l->id)
                                                {{$l->khoi}}{{$l->name}}
                                            @endif                                                   
                                            @endforeach
                                            @else
                                            Chưa phân lớp
                                            @endif
                                        </td>

                                        <td class="hidden-phone">{{ $student->address }}</td>
                                        <td class="hidden-phone">{{ $student->phone }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('student.edit', $student->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Sửa </a>
                                            <button type="button" data-toggle="modal"
                                                data-target="#myModal{{ $student->id }}" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash-o "></i> Xóa</button>
                                        </td>
                                        <input type="hidden" id='idStudent' value="{{$student->id}}">
                                    </tr>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal{{ $student->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color: #17a2b8">
                                                <!-- Modal Header -->
                                                <div class="modal-header" style="border-top:0">
                                                    <h4 class="modal-title">Xóa dữ liệu</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body text-center ">

                                                    Bạn có chắc muốn xóa!!!!!

                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer" style="border-top:0">
                                                    <a href="{{ route('student.delete', $student->id) }}" 
                                                        class="btn btn-danger btn-delete" >Xóa</a>
                                                    <a href="" class="btn btn-primary" data-dismiss="modal">Quay lại</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal thêm mới học sinh -->
                                    {{-- <div class="modal" id="mymodal">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color: #17a2b8">
                                                <!-- Modal Header -->
                                                <div class="modal-header" style="border-top:0">
                                                    <h4 class="modal-title">Thêm mới học sinh</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body text-center ">

                                                    <form action="{{ route('student.store') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="group">
                                                            <div class="form-group col-lg-6 text-left">
                                                                <label for="name">Họ và tên</label></label>
                                                                <input type="text" class="form-control" name='name'
                                                                    id="name" placeholder="Enter Your Name" required>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('name'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('name') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-lg-6 text-left">
                                                                <label for="birthday">Ngày sinh</label></label>
                                                                <input type="date" class="form-control" name='birthday'
                                                                    id="birthday" placeholder="Enter Your Birthday"
                                                                    required>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('birthday'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('birthday') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="group">
                                                            <div class="form-group col-lg-6 text-left">
                                                                <label for="phone">Điện thoại</label>
                                                                <input type="text" class="form-control" name='phone'
                                                                    id="phone" placeholder="Enter Your Mobile Number"
                                                                    required>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('phone'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('phone') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-lg-6 text-left">
                                                                <label for="MaLH">Lớp</label>
                                                                <select name="MaLH" id="MaLH" class="form-control"
                                                                    required>
                                                                    <option value="{{$v->idLop}}">{{$v->khoi . $v->lop}}</option>
                                                                </select>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('MaLH'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('MALH') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="group">
                                                            <div class="form-group col-lg-6 text-left ">
                                                                <label for="gender">Giới tính</label>
                                                                <select name="gender" id="gender" class="form-control"
                                                                    required>
                                                                    <option>Chọn giới tính</option>
                                                                    <option value="Nam">Nam</option>
                                                                    <option value="Nữ">Nữ</option>
                                                                </select>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('gender'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('gender') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-lg-6 text-left">
                                                                <label for="image">Avata</label>
                                                                <input type="file" class="form-control" name='image'
                                                                    accept=".jpg, .jpeg, .png, .bmp, .gif, .svg" id="image"
                                                                    placeholder="Enter Your Avata">

                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('image'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('image') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="group">
                                                            <div class="form-group col-lg-12 text-left">
                                                                <label for="address">Địa chỉ</label>
                                                                <textarea name="address" class="form-control" id="address" cols="10" rows="3" required></textarea>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('address'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('address') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name='id_lh' value="{{$v->idLop}}">


                                                        <div class="form-group py-2 float-left">
                                                            <div class="icheck-material-white">
                                                                <input type="checkbox" id="user-checkbox1" checked="" />
                                                                <label for="user-checkbox1">I Agree Terms &
                                                                    Conditions</label>
                                                            </div>
                                                        </div>


                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer" style="border-top:0">

                                                    <div class="form-group col-lg-6">
                                                        <a href="" class="btn btn-light px-5 ml-4 "
                                                            data-dismiss="modal">Quay lại</a>
                                                    </div>
                                                    <div class="form-group col-lg-6">

                                                        <button type="submit" class="btn btn-light px-5 float-right"
                                                            id='submit'>Lưu</button>
                                                    </div>


                                                </div>
                                            </div>

                                            </form>
                                        </div>
                                    </div> --}}
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                {{-- <div class=" float-right paginator">
                    {{ $students->appends($_GET)->links() }}
                </div> --}}
            </div>
        </div>
    </div>

@endsection


@section('toastr')
    @if (Session::has('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}");
        </script>
    @endif
@endsection
