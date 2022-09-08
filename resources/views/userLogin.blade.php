<title>Login Page</title>
<link rel="stylesheet" href="<?php echo asset('css/userLogin.css') ?>" type="text/css">
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
<link rel="icon" href="{!! asset('images/login_logo.jpeg') !!}" />

<style>
    body {
        background-image: url('images/login_background.jpeg');
    }
</style>

<!-- Page Content -->
<center>
    <div class='content_container'>

        <div class='login_form_container'>
            &nbsp
            <table style='width:50%; text-align:center'>
                <tr>
                    <td>
                        <img src='images/login_logo.jpeg' height='100px' width='100px'>
                    </td>
                    <td>
                        <h1> Login Page </h1>
                    </td>
                </tr>
            </table>

            <form action="{{route('userLogin')}}" method="post" class="form-group">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

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