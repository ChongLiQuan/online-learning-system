@include('admin/adminHeader')

<div class="home-content">

    <center>
        <h1> Register New Student </h1>
        &nbsp;
        <form action="{{route('addStudent')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class='login_field'>
                <table style='width:40%; text-align:right; margin-right:10%'>
                    <tr>
                        <th>
                            <h4>
                                <lable>Student Name:</label>
                                    <input type="form_name" name="stu_name" class="edu_input" placeholder="Student Name" autocomplete="off" required>
                            </h4>
                            @error('stu_name')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                        <th>
                            <h4>
                                <lable>Student IC:</label>
                                    <input type="form_name" name="stu_IC" class="edu_input" placeholder="Student IC" autocomplete="off" required>
                            </h4>
                            @error('stu_IC')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <h4>
                                <lable>Student Form:</label>
                                    <input type="form_name" name="stu_form" class="edu_input" min="0" max="50" placeholder="Form/Tingkatan" autocomplete="off" required>
                            </h4>
                            @error('stu_form')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                        <th>
                            <h4>
                                <lable>Student Age:</label>
                                    <input type="form_name" name="stu_age" min="13" max="19" class="edu_input" placeholder="Student Age" autocomplete="off" required>
                            </h4>
                            @error('stu_age')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <lable>Student Address:</label>
                                    <input type="form_name" name="stu_address" class="edu_input" placeholder="Student Address" autocomplete="off" required>
                            </h4>
                            @error('stu_address')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror

                        </th>
                        <th>
                            <h4>
                                <lable>Student Email:</label>
                                    <input type="form_name" name="stu_email" class="edu_input" placeholder="Student Email" autocomplete="off" required>
                            </h4>
                            @error('stu_email')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <label for="gender">Student Gender:</label>
                                <select name='stu_gender'>
                                    <option value="" selected disabled hidden>Select here</option>
                                    <option name="form_name" value="female">Female</option>
                                    <option name="form_name" value="male">Male</option>

                                </select>

                            </h4>
                        </th>
                        <th>
                            <h4>
                                <label for="birthday">Student Birthday:</label>
                                <input type="date" max="2022-01-01" id="birthday" name="stu_dob" required>
                            </h4>
                        </th>
                    </tr>

                    <tr>
                        <th> <label>Student Class:</label>
                            <select name='stu_class'>
                                @foreach($class as $class)
                                <option name="form_name" value="{{ $class->class_name }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>

                    <tr>
                        <th>&nbsp;</th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <lable>Parent's Name:</label>
                                    <input type="form_name" name="parent_name" class="edu_input" placeholder="Parent's Name" autocomplete="off" required>
                            </h4>
                            @error('parent_name')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                        <th>
                            <h4>
                                <lable>Parent's IC:</label>
                                    <input type="form_name" name="parent_IC" class="edu_input" placeholder="Parent's IC" autocomplete="off" required>
                            </h4>
                            @error('parent_IC')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <lable>Parent's HP:</label>
                                    <input type="form_name" name="parent_hp" class="edu_input" placeholder="Parent's HP" autocomplete="off" required>
                            </h4>
                            @error('parent_hp')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                        <th>
                            <h4>
                                <lable>Parent's Occupation:</label>
                                    <input type="form_name" name="parent_job" class="edu_input" placeholder="Parent's Occupation" autocomplete="off" required>
                            </h4>
                            @error('parent_job')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <lable>Parent's Age:</label>
                                    <input type="form_name" name="parent_age" class="edu_input" placeholder="Parent's Age" autocomplete="off" required>
                            </h4>
                            @error('parent_age')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                        <th>
                            <h4>
                                <lable>Parent's Address:</label>
                                    <input type="form_name" name="parent_address" class="edu_input" placeholder="Parent's Address" autocomplete="off" required>
                            </h4>
                            @error('parent_address')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </th>
                    </tr>

                    <tr>
                        <th>

                            <h4>
                                <label for="parent_relation">Relationship:</label>
                                <select name='parent_relation'>
                                    <option value="" selected disabled hidden>Select one</option>
                                    <option name="form_name" value="father">Father</option>
                                    <option name="form_name" value="mother">Mother</option>
                                    <option name="form_name" value="guardian">Guardian</option>
                                </select>

                            </h4>
                        </th>
                        <th>
                            <h4>
                                <label for="parent_dob">Parent's Birthday:</label>
                                <input type="date" max="2000-01-01" id="birthday" name="parent_dob" required>
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
        <h1> Existing Student Name List</h1>

        @if (session('delete_status'))
        <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
        @endif

        <table class='sortable' style='text-align: center; margin-top:2%'>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>IC no.</th>
                <th>Form</th>
                <th>Class</th>
                <th>Age</th>
                <th>Address</th>
                <th>Email</th>
                <th>Gender</th>
                <th>D.O.B</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            @foreach($students as $student)

            <tr>
                <td>
                    <h4> {{ $student->student_id }} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_name}} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_IC }} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_form }} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_class }} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_age }} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_address }} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_email }} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_gender }} </h4>
                </td>

                <td>
                    <h4> {{ $student->student_dob }} </h4>
                </td>

                <td>
                    <form action="{{route('editStudentRoute')}}" method="post" class="form-group">
                        <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                        <input type='hidden' name='student_id' value="{{ $student->student_id }}">
                        <button class="button login_submit">
                            <span class="button_text">Edit</span>
                        </button>
                    </form>
                </td>

                <td>
                    <form action="{{route('deleteStudent')}}" method="post" class="form-group">
                        <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                        <input type='hidden' name='delete_student' value="{{ $student->student_id }}">
                        <button class="button login_submit">
                            <span class="button_text" onclick="return confirm('Are you sure?')">Remove</span>
                        </button>
                    </form>
                </td>
            </tr>

            @endforeach

        </table>
</div>