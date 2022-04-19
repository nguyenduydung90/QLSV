@extends('master')
@section('css')
<style>
/* .sm{
    width: 40%;
    float: right;
    margin-right: 5px;
    margin-left: 20px; */
/* } */
.form-group{
    margin-right: 20px;
}
.btn-search{
    width: 40%;
    float: left;
    padding-left: 200px;
}
.btn-add{
    width: 30%;
    float: right;
    
}

.add{
    float: right;
    margin-right: 30px;
}

.search{
width: 50%;
}
.count-teacher{
    width: 30%;
    float: right;
    padding-left: 284px;
}

.card .table td{
    line-height: 52px;
}

label{
    float: left;
    margin-right: 5px;
    line-height: 40px;
}

</style>
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card">
        <h5 class="card-title mt-3 ml-3">Danh sách giáo viên</h5>
        <div class="group">
            <div class="btn-add">
                <a  class='btn btn-info add' href="{{route('user.create')}}">Thêm giáo viên</a>
            </div>
            <div class="count-teacher ">
                <label for="hoten">Tổng số giáo viên: </label>
                <input type="text" class="form-control" id="soluong" value="{{$count}}"  style="width: 45px" disabled>
            </div>   
            <div class="btn-search">
                <label for="hoten">Tìm kiếm: </label>
                <input type="text" class="form-control search" name='keyword' id='keyword' placeholder="Nhập thông tin muốn tìm kiếm">
                {{-- <span class="search">Tìm kiếm:</span> --}}
                
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
              {{-- <th scope="col">Giới tinh</th> --}}
              {{-- <th scope="col">Ngày sinh</th> --}}
              <th scope="col">Địa chỉ</th>
              <th scope="col">Email</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">Quản lý</th>
            </tr>
          </thead>
          <tbody id= 'listUser'>
            @if (!$users)

            <tr>
                <td colspan="7" class="text-center">Chưa có dữ liệu</td>
            </tr>
                                    
            @else
                @foreach ($users as $key => $u)
                <tr>
                    <td scope="row">
                        {{ ++$key }}
                    </td>
                    <td class="hidden-phone"><img src="{{ $u->image }}" alt="" style="width: 55px; height: 50px"></td>
                    <td class="hidden-phone text-left" >{{ $u->name }}</td>
                    <td class="hidden-phone">{{ $u->address }}</td>
                    <td class="hidden-phone">{{ $u->email }}</td>
                    <td class="hidden-phone">{{ $u->phone }}</td>
                    <td>
                        <a href="{{route('user.edit', $u->id)}}"
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
                        <button type="button" data-toggle="modal" data-target="#myModal{{$u->id}}"
                            class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i> Xóa</button>
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
@endif

          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>

@endsection
@section('js')
<script>
           
       $(document).ready(function(){
            $('#keyword').on('keyup',function(){
                
                var keyword= $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{route('user.search')}}",
                    data: {
                        keyword: keyword
                    },
                    dataType: 'json',
                    success: function(response){
                        
                        console.log(response);
                        $('#listUser').html(response);
                    }
                })
            });
        })
</script> 
@endsection
@section('toastr')
    @if (Session::has('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}");
        </script>
    @endif
@endsection