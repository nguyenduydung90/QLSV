@extends('master')
@section('css')
    <style>
        .group {
            display: flex;
        }

    </style>
@endsection
@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Thêm giáo viên</div>
                    <hr>
                    <form action="{{ route('registered') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="group">
                            <div class="form-group col-lg-4">
                                <label for="name">Họ và tên</label></label>
                                <input type="text" class="form-control" name='name' id="name" placeholder="Enter Your Name"
                                    required>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input-1">Ngày sinh</label></label>
                                <input type="date" class="form-control" name='birthday' id="input-1"
                                    placeholder="Enter Your Birthday" required>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('birthday'))
                                        <p class="text-danger">{{ $errors->first('birthday') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input-2">Email</label>
                                <input type="text" class="form-control" name='email' id="input-2"
                                    placeholder="characters@characters.domain" required
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="group">
                            <div class="form-group col-lg-4">
                                <label for="phone">Điện thoại</label>
                                <input type="text" class="form-control" name='phone' id="phone"
                                    placeholder="Enter Your Mobile Number" required>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="input-3">Giới tính</label>
                                <select name="gender" id="input-3" class="form-control" required>
                                    <option value="">Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('gender'))
                                        <p class="text-danger">{{ $errors->first('gender') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="file_upload">Avata</label>
                                <input type="file" class="form-control" name='image' id="file_upload"
                                    accept=".jpg, .jpeg, .png, .bmp, .gif, .svg" placeholder="Enter Your Avata">

                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('image'))
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="group">
                            <div class="form-group col-lg-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Enter Password" required>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" name='passwordconfirm' id="confirm_password"
                                    placeholder="Confirm Password" required>
                                <div class="position-relative has-icon-right mt-2 ml-1">
                                    <span id='message' class=""></span>
                                    @if ($errors->first('passwordconfirm'))
                                        <p class="text-danger">{{ $errors->first('passwordconfirm') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <div class="form-group col-lg-6">
                                <label for="address">Địa chỉ</label>
                                <textarea name="address" class="form-control" id="address" cols="10" rows="3" required></textarea>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
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
                            <a href="{{ route('user.listUser') }}" class="btn btn-light px-5 ">Quay lại</a>
                            <button type="submit" class="btn btn-light px-5 float-right">Lưu</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#password, #confirm_password').on('keyup', function() {
                if ($('#password').val() == $('#confirm_password').val()) {
                    $('#message').html('Nhập lại mật khẩu đúng').css('color', 'green');
                } else
                    $('#message').html('Nhập lại mật khẩu chưa đúng').css('color', 'red');
            });
        })
    </script>
@endsection
