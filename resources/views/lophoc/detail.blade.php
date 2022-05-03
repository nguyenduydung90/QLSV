@extends('master')
@section('css')
    <style>
        .sm {
            width: 40%;
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

        .btn-choose-class {
            width: 30%;
            float: left;
            margin-left: 141px
        }

        .btn-choose-hoten {
            width: 30%;
            float: left;
            margin-top: 8px;
            padding-left: 32px;
        }

        .giaovien {
            float: left;
            line-height: 40px;
            margin-right: 5px;
        }

        .count-student {
            width: 30%;
            float: left;
            margin-top: 8px;
        }

        .group {
            display: flex;
        }

        .form-group {
            margin-right: 9px;
        }

        .siso {
            float: left;
            line-height: 40px;
            margin-left: 37px;
        }

        #soluong {
            float: left;
            margin-left: 5px;
            background: none;
        }

        #hoten {
            background: none;
        }

    </style>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="group">
                <div class="title">
                    <h5 class="card-title mt-3 ml-3 ">Danh sách học sinh lớp: {{ $lophoc->khoi . $lophoc->name }}</h5>
                </div>
                <div class="btn-add ">
                    <button class='btn btn-info mt-3 float-right mr-3 ' id="addHS">Thêm học
                        sinh</button>
                </div>

            </div>
            <div class="group">

                <div class="btn-choose-hoten ">

                    <label for="hoten" class="giaovien">Giáo viên chủ nhiệm: </label>
                    <input type="text" class="form-control sm " id='hoten' value="{{ $lophoc->user->name }}" name='hoten'
                        disabled>


                </div>
                <div class="count-student ">
                    <label for="hoten" class='siso'>Sĩ số: </label>
                    <input type="text" class="form-control" id="soluong" value="{{ $count }}" style="width: 45px"
                        disabled>
                </div>
                <div class="btn-choose-class ">
                    <div class="btn-add ">
                        <a href="{{ route('lophoc.index') }}" class='btn btn-info mt-3 float-right mr-3 '><i
                                class="fa fa-backward"></i> Quay lại</a>
                    </div>

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
                                <th scope="col">Lớp</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col " style="text-align: right; padding-right: 41px;">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody id='listStudent'>

                            @if ($count == 0)
                                <tr>
                                    <td colspan="7" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                            @else
                                @foreach ($data as $key => $v)
                                    <tr>
                                        <td scope="row">
                                            {{ ++$key }}
                                        </td>
                                        <td class="hidden-phone"><img src="{{ asset($v->image) }}" alt=""
                                                style="width: 60px; height: 50px"></td>

                                        <td class="hidden-phone text-left">{{ $v->name }}</td>
                                        <td class="hidden-phone text-left">
                                            {{ $v->idLop == 'null' ? 'Chưa phân lớp' : $v->khoi . $v->lop }}</td>

                                        <td class="hidden-phone">{{ $v->address }}</td>
                                        <td class="hidden-phone">{{ $v->phone }}</td>
                                        <td class="text-right">
                                            <button data-toggle="modal" data-target="#Mymodal{{ $v->id }}"
                                                type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i>
                                                Sửa</button>
                                            <button type="button" data-toggle="modal"
                                                data-target="#myModal{{ $v->id }}" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash-o "></i> Xóa</button>
                                        </td>

                                    </tr>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal{{ $v->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color: #17a2b8">
                                                <!-- Modal Header -->
                                                <div class="modal-header" style="border-top:0">
                                                    <h4 class="modal-title">Xóa dữ liệu</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <form action="{{ route('student.delete', $v->id) }}">
                                                    <div class="modal-body text-center ">

                                                        Bạn có chắc muốn xóa!!!!!
                                                        <input type="hidden" name='namepage' value="listDetailClass">
                                                        <input type="hidden" name='idLop' value="{{ $v->idLop }}">
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer" style="border-top:0">
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                        <a href="" class="btn btn-primary" data-dismiss="modal">Quay lại</a>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>



                                    <!-- Modal sửa học sinh -->
                                    <div class="modal" id="Mymodal{{ $v->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color: #17a2b8">
                                                <!-- Modal Header -->
                                                <div class="modal-header" style="border-top:0">
                                                    <h4 class="modal-title">Cập nhật học sinh</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body text-center ">

                                                    <form id='form-edit' action="{{ route('student.update', $v->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="group">
                                                            <div class="form-group col-lg-6 text-left">
                                                                <label for="name">Họ và tên</label></label>
                                                                <input type="text" class="form-control" name='name'
                                                                    id="name" value="{{ $v->name }}"
                                                                    placeholder="Enter Your Name" required>
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
                                                                    id="birthday" value="{{ $v->birthday }}"
                                                                    placeholder="Enter Your Birthday" required>
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
                                                                    id="phone" value="{{ $v->phone }}"
                                                                    placeholder="Enter Your Mobile Number" required>
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
                                                                    @foreach ($lophocs as $key => $l)
                                                                        <option value="{{ $l->id }}"
                                                                            {{ $v->MaLH == $l->id ? "selected='seclected'" : '' }}>
                                                                            {{ $l->khoi }}{{ $l->name }}
                                                                        </option>
                                                                    @endforeach
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
                                                                    <option value="Nam"
                                                                        {{ $v->gender == 'Nam' ? "selected='seclected'" : '' }}>
                                                                        Nam</option>
                                                                    <option value="Nữ"
                                                                        {{ $v->gender == 'Nữ' ? "selected='seclected'" : '' }}>
                                                                        Nữ
                                                                    </option>
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
                                                                <input type="file" id='file' class="form-control"
                                                                    name='image'
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
                                                                <textarea name="address" class="form-control" id="address" cols="10" rows="3" required>{{ $v->address }}</textarea>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('address'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('address') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name='id_lh' value="listStudentInlop">


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
                                    </div>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal thêm mới học sinh -->
    <div class="modal" id="mymodal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="background-color: #17a2b8">
                <!-- Modal Header -->
                <div class="modal-header" style="border-top:0">
                    <h4 class="modal-title">Thêm học sinh vào lớp</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body text-center ">


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Lớp</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col " style="text-align: right; padding-right: 41px;">Quản lý</th>
                                    </tr>
                                </thead>
                                <tbody id='listStudent'>
                                    @foreach ($students as $key => $student)
                                        <tr>
                                            <td scope="row">
                                                {{ ++$key }}
                                            </td>
                                            <td class="hidden-phone"><img src="{{ asset($student->image) }}" alt=""
                                                    style="width: 60px; height: 50px"></td>

                                            <td class="hidden-phone text-left">{{ $student->name }}</td>
                                            <td class="hidden-phone">
                                                @if (in_array($student->MaLH, $lophocId))
                                                    @foreach ($lophocs as $l)
                                                        @if ($student->MaLH == $l->id)
                                                            {{ $l->khoi }}{{ $l->name }}
                                                        @endif
                                                    @endforeach
                                                @else
                                                    Chưa phân lớp
                                                @endif
                                            </td>

                                            <td class="hidden-phone">{{ $student->address }}</td>
                                            <td class="hidden-phone">{{ $student->phone }}</td>
                                            <td class="text-right">
                                                <form action="{{ route('student.update', $student->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name='id_lh' value="listStudentInlop"
                                                        class="id_lh">
                                                    <input type="hidden" name='name' value="{{ $student->name }}">
                                                    <input type="hidden" name='gender' value="{{ $student->gender }}">
                                                    <input type="hidden" name='phone' value="{{ $student->phone }}">
                                                    <input type="hidden" name='address' value="{{ $student->address }}">
                                                    <input type="hidden" name='birthday' value="{{ $student->birthday }}">
                                                    <input type="hidden" name='MaLH' value="{{ $lophoc->id }}">
                                                    <button type="submit"
                                                        class="btn btn-light px-5 float-right">Chọn</button>

                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>




                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#addHS').on('click', function() {
                $('#mymodal').modal('show');
            });
        })

    </script>
@endsection
