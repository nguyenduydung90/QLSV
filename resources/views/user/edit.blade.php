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
                    <div class="card-title">Sửa giáo viên</div>
                    <hr>
                    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="group">
                            <div class="form-group col-lg-4">
                                <label for="name">Họ và tên</label></label>
                                <input type="text" class="form-control" name='name' value="{{ $user->name }}" id="name"
                                    placeholder="Enter Your Name" required>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="birth">Ngày sinh</label></label>
                                <input type="date" class="form-control" name='birthday' value="{{ $user->birthday }}"
                                    id="birth" placeholder="Enter Your Birthday" required>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('birthday'))
                                        <p class="text-danger">{{ $errors->first('birthday') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name='email' value="{{ $user->email }}"
                                    id="email" placeholder="Enter Your Email Email" required>
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
                                <input type="text" class="form-control" name='phone' value="{{ $user->phone }}"
                                    id="phone" placeholder="Enter Your Mobile Number" required>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="gender">Giới tính</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option>Chọn giới tính</option>
                                    <option value="Nam" {{ $user->gender == 'Nam' ? "selected='seclected'" : '' }}>Nam</option>
                                    <option value="Nữ" {{ $user->gender == 'Nữ' ? "selected='seclected'" : '' }}>Nữ</option>
                                </select>
                                <div class="position-relative has-icon-right">
                                    @if ($errors->first('gender'))
                                        <p class="text-danger">{{ $errors->first('gender') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="image">Avata</label>
                                <input type="file" class="form-control" name='image' id="image"
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

                                <div class="position-relative has-icon-right">
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
                                <textarea name="address" value="{{ $user->address }}" class="form-control" id="address" cols="10" rows="3"
                                    required>{{ $user->address }}</textarea>
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
                    $('#message').html('Nhập lại khẩu đúng').css('color', 'green');
                } else
                    $('#message').html('Nhập lại mật khẩu chưa đúng').css('color', 'red');
            });
        })
    </script>
@endsection
