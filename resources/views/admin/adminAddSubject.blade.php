@include('admin/adminHeader')

<div class="home-content">

    <center>
        <h1> Add New Subject </h1>
        <form action="{{route('addSubject')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class='login_field'>
                <table style='width:40%; text-align:center;'>
                    <tr>
                        <th>
                            <h4>
                                <lable>Subject Code:</label>
                                    <input type="form_name" name="subject_code" class="edu_input" placeholder="Subject Code" autocomplete="off" required>
                            </h4>
                        </th>
                        <th>
                            <h4>
                                <lable>Subject Name:</label>
                                    <input type="form_name" name="subject_name" class="edu_input" placeholder="Subject Name" autocomplete="off" required>
                            </h4>
                        </th>
                    </tr>
                </table>

                <h4>
                    <label>Choose a Class:</label>

                    <select name='class_name'>
                        @foreach($classes as $class)
                        <option name="class_name" value="{{ $class->class_name }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>

                    @if (session('pass_status'))
                    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
                    @endif

                    @if (session('error_status'))
                    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
                    @endif

                    <button class="button login_submit">
                        <span class="button_text">Add Now</span>
                        <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
                    </button>

            </div>
        </form>

        <div class="list_container">
            <hr />
            <div class="list_container">

                <h1> Assign Existing Subject </h1>
                <form action="{{route('addExistingSubject')}}" method="post" class="form-group">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                    <div class='login_field'>
                        <h4>
                            <label>Choose a Existing Subject:</label>

                            <select name='subject_code'>
                                @foreach($subjects as $subject)
                                <option name="subject_code" value="{{ $subject->subject_code }}">{{ $subject->subject_code }}</option>
                                @endforeach
                            </select>


                            <label>Choose a Class:</label>

                            <select name='class_name'>
                                @foreach($classes as $class)
                                <option name="class_name" value="{{ $class->class_name }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>



                            @if (session('pass_status_existing'))
                            <p style="text-align:center; color:green;"><b>{{ session('pass_status_existing') }}</b></p>
                            @endif

                            @if (session('error_status_existing'))
                            <p style="text-align:center; color:red;"><b>{{ session('error_status_existing') }}</b></p>
                            @endif

                            <button class="button login_submit">
                                <span class="button_text">Add Now</span>
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
                    <h1>Existing Subject List </h1>

                    <table style=' width:29%;'>
                        <tr>
                            <th style='text-align: left;'>
                                <form action="{{route('filterSubject')}}" method="post" class="form-group">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <select name='filter_class'>
                                        @foreach($classes as $class)
                                        <option name="form_name" value="{{ $class->class_name }}">{{ $class->class_name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="button login_submit">
                                        <span class="button_text">Search</span>
                                    </button>
                                </form>
                            </th>
                            <th style='text-align: right;'>

                                <form action="adminAddSubject">
                                    <button class="button login_submit">
                                        <span class="button_text">Display All</span>
                                </form>
                            </th>
                        </tr>

                        @if (session('delete_status'))
                        <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
                        @endif

            </div>

            <center>

                <table class='sortable' style='text-align: center; margin-top:2%; width:50%'>

                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Class Name</th>
                        <th>Delete</th>
                    </tr>

                    @foreach($subjects as $subject)

                    <tr>
                        <td>
                            <h4> {{ $subject->subject_code }} </h4>
                        </td>

                        <td>
                            <h4> {{ $subject->subject_name }} </h4>
                        </td>

                        <td>
                            <h4> {{ $subject->class_name }} </h4>
                        </td>

                        <td>
                            <form action="{{route('deleteClass')}}" method="post" class="form-group">
                                <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                                <input type='hidden' name='delete_class' value="{{ $subject->subject_name }}">
                                <button class="button login_submit">
                                    <span class="button_text">Delete Class</span>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @endforeach

                </table>
        </div>