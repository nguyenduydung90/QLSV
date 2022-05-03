@extends('master')
@section('css')
    <style>
        .form-group {
            margin-right: 9px;
        }

        .card .table td {
            line-height: 52px;
        }

        .group {
            display: flex;
        }

        .btn-add {
            /* display: flex; */
            float: right;
            margin-right: 10px;
        }

        .title {
            float: left;
        }

        .btn-create {
            margin-left: 5px;

        }

        .choose {
            float: left;
            margin-left: 44px;
            margin-right: 8px;
            line-height: 40px;
        }

        .btn-search {
            margin-top: 30px;
        }

        .choose-khoi {
            width: 30%;
            float: left;
        }

        .search {
            width: 40%;
            float: left;
        }

        .count {
            width: 30%;
            float: left;
        }

        #hoten {
            width: 61%;
            float: left;
        }

        #khoiSearch {
            width: 60%;
            float: left;
        }

        #soluong {
            background: none;
        }

    </style>
@endsection
@section('content')

    <div class="container" style="width:50%">

        <div class="card">
            <div class="header">
                <div class="title">
                    <h5 class="card-title mt-3 ml-3 ">Danh sách lớp học</h5>
                </div>

                <div class="btn-add ">
                    <a class='btn btn-outline-info mt-3 ' href="{{route('lophoc.create')}}">Thêm lớp</a>
                    {{-- <button class="btn btn-outline-info mt-3 btn-create " id="addHS">Thêm mới học sinh</button> --}}
                </div>
            </div>

            <div class="btn-search">
                <div class="choose-khoi">
                    <div class="btn-choose-class ">
                        <label for="khoi" class='choose'>Khối: </label>
                        <select name="khoiSearch" id="khoiSearch" class="form-control">
                            <option value="">--Chọn khối--</option>
                            <option value="">Tất cả các khối</option>
                            @foreach ($khois as $key => $k)
                                <option value="{{ $k->khoi }}">{{ $k->khoi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="search">
                    <label for="hoten" class='choose'>Tìm kiếm: </label>
                    <input type="text" class="form-control " name='lop' id='hoten'
                        placeholder="Nhập tên giáo viên muốn tìm">
                </div>
                <div class="count">
                    <label for="soluong" class='choose'>Tổng số lớp: </label>
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
                                <th scope="col">Lớp</th>
                                <th scope="col">GVCN</th>
                                <th scope="col" style="Âtext-align: right; padding-right: 46px;">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody id='listUser'>
                            @if (!$lophocs)
                                <tr>
                                    <td colspan="4" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                            @else
                                @foreach ($lophocs as $key => $l)
                                    <tr>
                                        <td scope="row">
                                            {{ ++$key }}
                                        </td>


                                        <td class="hidden-phone ">{{ $l->khoi }}{{ $l->name }}</td>
                                        <td class="hidden-phone">{{ $l->GVCN }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('lophoc.detail', $l->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-tasks"> Chi tiết</i>
                                            </a>
                                            <a href="{{ route('lophoc.edit', $l->id) }}" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-pencil"></i> Sửa</a>
                                            <button type="button" data-toggle="modal"
                                                data-target="#myModal{{ $l->id }}" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash-o "></i> Xóa</button>
                                        </td>
                                    </tr>

                                    <!-- The Modal del -->
                                    <div class="modal" id="myModal{{ $l->id }}">
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
                                                    <a href="{{ route('lophoc.delete', $l->id) }}"
                                                        class="btn btn-danger">Xóa</a>
                                                    <a href="{{ route('lophoc.index') }}" class="btn btn-primary"
                                                        data-dismiss="modal">Quay lại</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal thêm mới lớp -->
                                    <div class="modal" id="mymodal">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="background-color: #17a2b8">
                                                <!-- Modal Header -->
                                                <div class="modal-header" style="border-top:0">
                                                    <h4 class="modal-title">Thêm Lớp</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body text-center ">

                                                    <form>

                                                        <div class="group">
                                                            <div class="form-group col-lg-6 text-left">
                                                                <label for="khoi">Khối</label></label>
                                                                <input type="text" class="form-control" name='khoi'
                                                                    id="khoi" placeholder="Enter Your Name" required>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('name'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('name') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="group">

                                                            <div class="form-group col-lg-6 text-left">
                                                                <label for="MaLH">Lớp</label>
                                                                <select name="name" id="MaLH" class="form-control" required>
                                                                    <option value="">--Chọn Lớp--</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="D">D</option>
                                                                </select>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('name'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('name') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="group">
                                                            <div class="form-group col-lg-6 text-left ">
                                                                <label for="MAGV">Giáo viên chủ nhiệm</label>
                                                                <select name="MAGV" id="MAGV" class="form-control"
                                                                    required>
                                                                    {{-- <option>Chọn GVCN</option>
                                                                    @foreach ($teachers as $key => $t)
                                                                    <option value="{{$t->id}}">{{$t->name}}</option>
                                                                    @endforeach --}}

                                                                </select>
                                                                <div class="position-relative has-icon-right">
                                                                    @if ($errors->first('MAGV'))
                                                                        <p class="text-danger">
                                                                            {{ $errors->first('MAGV') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="group">

                                                            <input type="hidden" name='id_lh' value="lophoc">


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

                    {{-- <div class=" float-right">
                    {{$lophocs->appends(Request::all())->links()}}
                </div> --}}

                </div>
            </div>
        </div>
    </div>


    <script>


    </script>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // $(document).on('click', '#addLop', function() {
            //     $("#mymodal").modal('show');
            //     $.ajax({
            //         type: 'get',
            //         url: "{{ route('lophoc.create') }}",
            //         dataType: 'json',
            //         success: function(respone) {

            //             $('#MAGV').append(respone);
            //         }
            //     })
            // });

            // $(document).on('click', '#submit', function() {
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     var khoi = $('#khoi').val();
            //     var lop = $('#MaLH').val();
            //     var magv = $('#MAGV').val();

            //     $.ajax({
            //         type: 'POST',
            //         url: "lophoc/store",
            //         data: {
            //             khoi: khoi,
            //             name: lop,
            //             MAGV: magv
            //         },
            //         dataType: 'JSON',
            //         success:function(respone){
            //             console.log(respone)
            //             alert(1);
            //             if(respone.status == success){
            //                 // location.load();
            //             }
            //         },error: function(message){
            //             alert(message);
            //         }

                    
            //     })
                // $("#mymodal").modal('hide');
            // })

            $('#hoten').on('keyup', function() {

                var hoten = $('#hoten').val();
                var khoi = $('#khoiSearch').val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('lophoc.search') }}",
                    data: {
                        hoten: hoten,
                        khoi: khoi
                    },
                    dataType: 'json',
                    success: function(response) {

                        console.log(response);
                        $('#listUser').html(response);
                        var sl = $('#count').val();
                        $('#soluong').val(sl)
                    }
                })
            });

            $(document).on('change', '#khoiSearch', function() {
                var hoten = $('#hoten').val();
                var khoi = $('#khoiSearch').val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('lophoc.search') }}",
                    data: {
                        hoten: hoten,
                        khoi: khoi
                    },
                    dataType: 'json',
                    success: function(response) {

                        console.log(response);
                        $('#listUser').html(response);
                        var sl = $('#count').val();
                        $('#soluong').val(sl)
                    }
                })
            });
        })
    </script>
@endsection
