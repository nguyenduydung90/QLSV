<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Quản lý sinh viên</title>
  <!-- loader-->
  <link href="{{'Css/assets/css/pace.min.css'}}" rel="stylesheet"/>
  <script src="{{'Css/assets/js/pace.min.js'}}"></script>
  <!--favicon-->
  <link rel="icon" href="{{'Css/assets/images/favicon.ico'}}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{'Css/assets/css/bootstrap.min.css'}}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{'Css/assets/css/animate.css'}}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{'Css/assets/css/icons.css'}}" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="{{'Css/assets/css/app-style.css'}}" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

	<div class="card card-authentication1 mx-auto my-4">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="{{'Css/assets/images/logo-icon.png'}}" alt="logo icon">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Đăng ký</div>
		    <form action="{{route('registered')}}" method="post" enctype="multipart/form-data">
          @csrf
			  <div class="form-group">
			  <label for="exampleInputName" class="sr-only">Name</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="exampleInputName" name='name' class="form-control input-shadow" placeholder="Enter Your Name">
			   </div>
         <div class="position-relative has-icon-right">
         @if($errors->first('name'))
         <p class="text-danger">{{$errors->first('name')}}</p>
         @endif
        </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputEmailId" class="sr-only">Email ID</label>
			   <div class="position-relative has-icon-right">
				  <input type="email" id="exampleInputEmailId" name='email' class="form-control input-shadow" placeholder="Enter Your Email ID">
			   </div>
         <div class="position-relative has-icon-right">
          @if($errors->first('email'))
          <p class="text-danger">{{$errors->first('email')}}</p>
          @endif
         </div>
			  </div>
			  <div class="form-group">
			   <label for="exampleInputPassword" class="sr-only">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputPassword" name='password' class="form-control input-shadow" placeholder="Choose Password">
				  </div>
          <div class="position-relative has-icon-right">
            @if($errors->first('password'))
            <p class="text-danger">{{$errors->first('password')}}</p>
            @endif
           </div>
			   </div>
			  </div>

        <div class="form-group">
          <label for="exampleInputPassword" class="sr-only">Confirm Password</label>
          <div class="position-relative has-icon-right">
           <input type="password" id="exampleInputPassword" name='passwordconfirm' class="form-control input-shadow" placeholder="Confirm Password">
          </div>
          <div class="position-relative has-icon-right">
            @if($errors->first('passwordconfirm'))
            <p class="text-danger">{{$errors->first('passwordconfirm')}}</p>
            @endif
           </div>
         </div>

         <div class="form-group">
          <label for="exampleInputEmailId" class="sr-only">Phone</label>
           <div class="position-relative has-icon-right">
            <input type="text" id="exampleInputEmailId" name='phone' class="form-control input-shadow" placeholder="Enter Your phone">
           </div>
           <div class="position-relative has-icon-right">
            @if($errors->first('phone'))
            <p class="text-danger">{{$errors->first('phone')}}</p>
            @endif
           </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmailId" class="sr-only">Ngày sinh</label>
             <div class="position-relative has-icon-right">
              <input type="date" id="exampleInputEmailId" name='birthday' class="form-control input-shadow" placeholder="Enter Your birthday">
             </div>
             <div class="position-relative has-icon-right">
              @if($errors->first('birthday'))
              <p class="text-danger">{{$errors->first('birthday')}}</p>
              @endif
             </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmailId" class="sr-only">Giới tính</label>
               <div class="position-relative has-icon-right">
                <select name="gender" id="" class="form-control input-shadow">
                  <option>Chọn giới tính</option>
                  <option value="Nam">Nam</option>
                  <option value="Nam">Nữ</option>
                </select>
               </div>
               <div class="position-relative has-icon-right">
                @if($errors->first('gender'))
                <p class="text-danger">{{$errors->first('gender')}}</p>
                @endif
               </div>
              </div>

              <div class="form-group">
                <label for="exampleInputEmailId" class="sr-only">Avata</label>
                <span>Avata:</span>
                 <div class="position-relative has-icon-right">
                  <input type="file" id="exampleInputEmailId" name='image' class="form-control input-shadow" >
                 </div>
                 <div class="position-relative has-icon-right">
                  @if($errors->first('image'))
                  <p class="text-danger">{{$errors->first('image')}}</p>
                  @endif
                 </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmailId" class="sr-only">Địa chỉ</label>
                  <span>Địa chỉ:</span>
                   <div class="position-relative has-icon-right">
                    <textarea type="file" id="exampleInputEmailId" name='address' class="form-control input-shadow" placeholder="Enter Your Address" ></textarea>
                   </div>
                   <div class="position-relative has-icon-right">
                    @if($errors->first('address'))
                    <p class="text-danger">{{$errors->first('address')}}</p>
                    @endif
                   </div>
                  </div>
			  

			  
			 <button type="submit" class="btn btn-light btn-block waves-effect waves-light">Đăng ký</button>
			  <div class="text-center mt-3">Sign Up With</div>
			  
			 <div class="form-row mt-4">
			  <div class="form-group mb-0 col-6">
			   <button type="button" class="btn btn-light btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
			 </div>
			 <div class="form-group mb-0 col-6 text-right">
			  <button type="button" class="btn btn-light btn-block"><i class="fa fa-twitter-square"></i> Twitter</button>
			 </div>
			</div>
			
			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		    <p class="text-warning mb-0">Already have an account? <a href="login.html"> Sign In here</a></p>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('Css/assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('Css/assets/js/popper.min.js')}}"></script>
  <script src="{{asset('Css/assets/js/bootstrap.min.js')}}"></script>
	
  <!-- sidebar-menu js -->
  <script src="{{asset('Css/assets/js/sidebar-menu.js')}}"></script>
  
  <!-- Custom scripts -->
  <script src="{{asset('Css/assets/js/app-script.js')}}"></script>
  
</body>
</html>
