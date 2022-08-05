@include('admin/adminHeader')

<div class="home-content">

    <center>
        <h1> Register New Educator </h1>
        &nbsp;
        <form action="{{route('addEducator')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class='login_field'>
                <table style='width:40%; text-align:right; margin-right:10%'>
                    <tr>
                        <th>
                            <h4>
                                <lable>Full Name:</label>
                                    <input type="form_name" name="edu_name" class="edu_input" placeholder="Full Name" autocomplete="off" required>
                            </h4>
                        </th>
                        <th>
                            <h4>
                                <lable>Malaysia IC:</label>
                                    <input type="form_name" name="edu_IC" class="edu_input" placeholder="IC Number" autocomplete="off" required>
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
                                    <input type="form_name" name="edu_year" class="edu_input" min="0" max="50" placeholder="Teaching Experience (Year)" autocomplete="off" required>
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
                                    <input type="form_name" name="edu_age" min="0" max="40" class="edu_input" placeholder="Age" autocomplete="off" required>
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
                                    <input type="form_name" name="edu_address" class="edu_input" placeholder="Full Address" autocomplete="off" required>
                            </h4>

                        </th>
                        <th>
                            <h4>
                                <lable>Email:</label>
                                    <input type="form_name" name="edu_email" class="edu_input" placeholder="Email" autocomplete="off" required>
                            </h4>
                        </th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <label for="gender">Gender:</label>
                                <select name='edu_gender'>
                                    <option value="" selected disabled hidden>Select here</option>
                                    <option name="form_name" value="female">Female</option>
                                    <option name="form_name" value="male">Male</option>

                                </select>

                            </h4>
                        </th>
                        <th>
                            <h4>
                                <label for="birthday">Birthday:</label>
                                <input type="date" max="2022-01-01" id="birthday" name="edu_dob" required>
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
                        <span class="button_text">Register Now</span>
                        <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
                    </button>

                </div>
        </form>

</div>

<div class="list_container">
    <!-- For the margin gap -->
</div>

<hr />

<div class="list_container">

    <center>
        <h1> Existing Educator Name List</h1>

        @if (session('delete_status'))
        <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
        @endif

        <table class='sortable' style='text-align: center; margin-top:2%'>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>IC no.</th>
                <th>Teaching Experience</th>
                <th>Age</th>
                <th>Address</th>
                <th>Email</th>
                <th>Gender</th>
                <th>D.O.B</th>
                <th>Delete</th>
            </tr>

            @foreach($educators as $educator)

            <tr>
                <td>
                    <h4> {{ $educator->edu_id }} </h4>
                </td>

                <td>
                    <h4> {{ $educator->edu_name}} </h4>
                </td>

                <td>
                    <h4> {{ $educator->edu_IC }} </h4>
                </td>

                <td>
                    <h4> {{ $educator->edu_year }} </h4>
                </td>

                <td>
                    <h4> {{ $educator->edu_age }} </h4>
                </td>

                <td>
                    <h4> {{ $educator->edu_address }} </h4>
                </td>

                <td>
                    <h4> {{ $educator->edu_email }} </h4>
                </td>

                <td>
                    <h4> {{ $educator->edu_gender }} </h4>
                </td>

                <td>
                    <h4> {{ $educator->edu_dob }} </h4>
                </td>

                <td>
                    <form action="{{route('deleteEducator')}}" method="post" class="form-group">
                        <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                        <input type='hidden' name='delete_edu' value="{{ $educator->edu_id }}">
                        <button class="button login_submit">
                            <span class="button_text">Delete Class</span>
                        </button>
                    </form>
                </td>
            </tr>

            @endforeach

        </table>
</div>