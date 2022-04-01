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

<div class="container" style="width:50%">
 
    <div class="card">

            <h5 class="card-title mt-3 ml-3">Danh sách lớp học</h5>


            <div class="card-title">
                <form action="{{route('lophoc.index')}}" class='form-group mt-3'>
                    <button type="submit" class="btn btn-light btn-search">Tìm</button>
                    <input type="text" class="form-control sm" name='keyword' placeholder="Enter keyword">
                    
                </form>
                <a  class='btn btn-info float-left ml-3' href="{{route('lophoc.create')}}">Thêm mới</a>
            </div>

      <div class="card-body">
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">STT</th>
              <th scope="col">Lớp</th>
              <th scope="col">GVCN</th>
              <th scope="col">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                @foreach ($lophocs as $key => $l)
                <tr>
                    <td scope="row">
                        {{ ++$key }}
                    </td>
                    

                    <td class="hidden-phone" style="text-align: center">{{ $l->name }}</td>
                    <td class="hidden-phone">{{ $l->GVCN}}</td>
                    <td class="text-right">
                        <a href="{{route('lophoc.edit', $l->id)}}"
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                        <button type="button" data-toggle="modal" data-target="#myModal{{$l->id}}"
                            class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button>
                    </td>
                </tr>

                <!-- The Modal -->
                <div class="modal" id="myModal{{$l->id}}">
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
                                <a href="{{route('lophoc.delete', $l->id)}}"
                                    class="btn btn-danger">Xóa</a>
                                <a href="{{route('lophoc.index')}}" class="btn btn-primary"
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