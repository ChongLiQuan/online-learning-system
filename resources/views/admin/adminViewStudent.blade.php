@include('admin/adminHeader')

<div class="home-content">

    <div class="list_container">

        <center>
            <h1> Existing Student Name List</h1>

            @if (session('delete_status'))
            <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
            @endif

            <table style=' width:29%;'>
                <tr>
                    <th style='text-align: left;'>
                        <form action="{{route('filterStudent')}}" method="post" class="form-group">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <input type="form_name" name="stu_id" class="field_search" placeholder="Student ID" autocomplete="off" required>
                    </th>
                    <th>
                        <button class="button login_submit">
                            <span class="button_text">Search</span>
                        </button>
                        </form>
                    </th>
                    <th style='text-align: right;'>

                        <form action="adminAddStudent">
                            <button class="button login_submit">
                                <span class="button_text">Display All</span>
                        </form>
                    </th>
                </tr>


                @if (session('pass_status'))
                <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
                @endif

                @if (session('error_status'))
                <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
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

                <center>
                    <div class='pagination'>
                        {{$students->links()}}
                    </div>
                </center>
    </div>