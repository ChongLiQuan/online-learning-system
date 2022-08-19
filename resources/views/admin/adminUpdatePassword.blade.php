@include('admin/adminHeader')

<div class="home-content">

    <center>
        <h1> Update Password for Existing User </h1>
        &nbsp;
        <form action="{{route('updatePassword')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class='login_field'>
                <table style='width:40%; text-align:right; margin-right:10%'>
                    <tr>
                        <th>
                            <h4>
                                <lable>Username:</label>
                                    <input type="form_name" name="user_name" class="edu_input" placeholder="Username" autocomplete="off" required>
                            </h4>
                            @error('user_name')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>

                        <th>
                            <h4>
                                <lable>New Password:</label>
                                    <input type="form_name" name="new_password" class="edu_input" placeholder="New Password" autocomplete="off" required>
                            </h4>
                            @error('user_name')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>
                </table>

                @if (session('pass_status'))
                <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
                @endif

                @if (session('error_status'))
                <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
                @endif
                <div class="list_container">

                    <button class="button login_submit">
                        <span class="button_text">Update Password</span>
                        <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
                    </button>

                </div>
        </form>

</div>

<div class="list_container">
    <!-- For the margin gap -->
</div>

<hr />