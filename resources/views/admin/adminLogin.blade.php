<title>Admin Login Page</title>
<link rel="stylesheet" href="<?php echo asset('css/adminLogin.css')?>" type="text/css"> 
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>

<!-- Page Content -->
<center>
<div class='content_container'>

    <img src='images/admin/admin_logo.png' height='300px' width='500px'> 

    <div class='login_form_container'>
    &nbsp

    <h1> Admin Login Page </h1>

        <div class='login_field'>
        <i class="login_icon fa fa-user" aria-hidden="true"></i>
        <input type="username" class="login_input" placeholder="Username">

        <div class='login_field'>
        <i class="login_icon fa fa-lock" aria-hidden="true"></i>
        <input type="password" class="login_input" placeholder="Password">

        <button class="button login_submit">
			<span class="button_text">Log In Now</span>
			<i class="button_icon fa-solid fa-chevron-right" aria-hidden="true"></i>
		</button>
        </div>
    </div>
</div>
</center>