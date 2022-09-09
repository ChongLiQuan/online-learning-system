<title>Admin Login Page</title>
<link rel="stylesheet" href="<?php echo asset('css/adminLogin.css')?>" type="text/css"> 
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
<link rel="icon" href="{!! asset('images/school_logo.png') !!}"/>

<!-- Page Content -->
<center>
<div class='content_container'>

    <img src='images/admin/admin_logo.png' height='300px' width='500px'> 

    <div class='login_form_container'>
    &nbsp

    <h1> Adminstrator Login Page </h1>
    <form action="/adminLoginPage" method="post" class="form-group"> 
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        
    <div class='login_field'>
        <i class="login_icon fa fa-user" aria-hidden="true"></i>
        <input type="username" name="username" class="login_input" placeholder="Username" autocomplete="off" required> 

        <div class='login_field'>
        <i class="login_icon fa fa-lock" aria-hidden="true"></i>
        <input type="password" name="password" class="login_input" placeholder="Password" autocomplete="off" required>

        @if (session('status'))
        <p style="text-align:center; color:red;"><b>{{ session('status') }}</b></p>
        @endif

        <button class="button login_submit">
		<span class="button_text">Log In Now</span>
		<i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i> 
		</button>

        </div>
    </form>
    </div>
</div>
</center>
</html>

<script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
</script>