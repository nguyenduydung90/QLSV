@extends('master')
@section('css')
<style>
.sm{
    width: 40%;
    float: right;
    margin-right: 5px;
}
.form-group{
    margin-right: 20px;
}
.btn-search{
    float:right;
}

.card .table td{
    line-height: 52px;
}

</style>
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card">
        <h5 class="card-title mt-3 ml-3">Danh sách giáo viên</h5>
        <div class="card-title">
            <form action="{{route('user.listUser')}}" class='form-group mt-3'>
                <button type="submit" class="btn btn-light btn-search">Tìm</button>
                <input type="text" class="form-control sm" name='keyword' placeholder="Enter keyword">
                
            </form>
            <a  class='btn btn-info float-left ml-3' href="{{route('user.create')}}">Thêm mới</a>
        </div>
      <div class="card-body">         
            <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Ảnh</th>
              <th scope="col">Họ và tên</th>
              {{-- <th scope="col">Giới tinh</th> --}}
              {{-- <th scope="col">Ngày sinh</th> --}}
              <th scope="col">Địa chỉ</th>
              <th scope="col">Email</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                @foreach ($users as $key => $u)
                <tr>
                    <td scope="row">
                        {{ ++$key }}
                    </td>
                    <td class="hidden-phone"><img src="{{ $u->image }}" alt="" style="width: 50px; height: 50px"></td>

                    <td class="hidden-phone text-left" >{{ $u->name }}</td>
                    {{-- <td class="hidden-phone">{{ $u->gender }}</td> --}}
                    {{-- <td class="hidden-phone">{{ $u->birthday }}</td> --}}
                    <td class="hidden-phone">{{ $u->address }}</td>
                    <td class="hidden-phone">{{ $u->email }}</td>
                    <td class="hidden-phone">{{ $u->phone }}</td>
                    <td>
                        <a href="{{route('user.edit', $u->id)}}"
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                        <button type="button" data-toggle="modal" data-target="#myModal{{$u->id}}"
                            class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button>
                    </td>
                </tr>

                <!-- The Modal -->
                <div class="modal" id="myModal{{$u->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #17a2b8" >
                            <!-- Modal Header -->
                            <div class="modal-header" style="border-top:0">
                                <h4 class="modal-title" >Xóa dữ liệu</h4>
                                <button type="button" class="close"
                                    data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body text-center " >
                                
                                Bạn có chắc muốn xóa!!!!!
                                
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer" style="border-top:0">
                                <a href="{{route('user.delete', $u->id)}}"
                                    class="btn btn-danger">Xóa</a>
                                <a href="{{route('user.listUser')}}" class="btn btn-primary"
                                    data-dismiss="modal">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>

@endforeach


          </tbody>
        </table>
      </div>
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