@include('admin/adminHeader')

<div class="home-content">

@foreach($educator as $e)

    <center>
        <h1> Update Educator Information</h1>
        &nbsp;
        <form action="{{route('editEducator')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class='login_field'>
                <table style='width:40%; text-align:right; margin-right:10%'>
                    <tr>
                        <th>
                            <h4>
                                <lable>Full Name:</label>
                                    <input type="form_name" value=" {{ $e->edu_name }}"  name="edu_name" class="edu_input" placeholder="Full Name" autocomplete="off" required>
                            </h4>
                        </th>
                        <th>
                            <h4>
                                <lable>Malaysia IC:</label>
                                    <input type="form_name" value=" {{ $e->edu_IC }}" name="edu_IC" class="edu_input" placeholder="IC Number" autocomplete="off" required disabled>
                            </h4>
                            @error('edu_IC')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <h4>
                                <lable>Teaching Experience:</label>
                                    <input type="form_name" value=" {{ $e->edu_year }}" name="edu_year" class="edu_input" min="0" max="50" placeholder="Teaching Experience (Year)" autocomplete="off" required>
                            </h4>
                            @error('edu_year')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                        <th>
                            <h4>
                                <lable>Age:</label>
                                    <input type="form_name" value=" {{ $e->edu_age }}" name="edu_age" min="0" max="40" class="edu_input" placeholder="Age" autocomplete="off" required>
                            </h4>
                            @error('edu_age')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <lable>Address:</label>
                                    <input type="form_name"  value=" {{ $e->edu_address }}" name="edu_address" class="edu_input" placeholder="Full Address" autocomplete="off" required>
                            </h4>

                        </th>
                        <th>
                            <h4>
                                <lable>Email:</label>
                                    <input type="form_name" value=" {{ $e->edu_email }}" name="edu_email" class="edu_input" placeholder="Email" autocomplete="off" required>
                            </h4>
                        </th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <label for="gender">Gender:</label>
                                <select name='edu_gender'>
                                    <option value="" selected disabled hidden>Select here</option>
                                    <option <?php if($e->edu_gender == 'female'){echo("selected");}?> name="form_name" value="female">Female</option>
                                    <option <?php if($e->edu_gender == 'male'){echo("selected");}?> name="form_name" value="male">Male</option>

                                </select>

                            </h4>
                        </th>
                        <th>
                            <h4>
                                <label for="birthday">Birthday:</label>
                                <input type="date" value="{{ $e->edu_dob }}" max="2022-01-01" id="birthday" name="edu_dob" required>
                            </h4>
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
                        <span class="button_text">Update Now</span>
                        <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
                    </button>

                </div>
        </form>

</div>

<div class="list_container">
    <!-- For the margin gap -->

@endforeach
</div>
