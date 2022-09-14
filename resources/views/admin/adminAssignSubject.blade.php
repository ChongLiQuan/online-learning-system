@include('admin/adminHeader')

<div class="home-content">

    <center>
        <h1> Assign Educator for Class Subject </h1>
        <form action="{{route('assignSubject')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class='login_field'>
                <label>Choose a Subject:</label>

                <select name='subject'>
                    @foreach($subjects as $s)
                    <option name="subject" value="{{ $s->subject_code }}">{{ $s->subject_code  }}</option>
                    @endforeach
                </select>

                <label>Choose a Class:</label>

                <select name='class'>
                    @foreach($class as $c)
                    <option name="class" value="{{ $c->class_name }}">{{ $c->class_name  }}</option>
                    @endforeach
                </select>

                <label>Choose a Educator:</label>

                <select name='educator'>
                    @foreach($educators as $e)
                    <option name="educator" value="{{ $e->edu_id }}">{{ $e->edu_id }}</option>
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

</div>

<div class="list_container">
    <!-- For the margin gap -->
</div>

<hr />
<div class="list_container">

    <center>
        <h1> Existing Class Subject List</h1>
        <div class="list_container">

            <center>

                <table class='sortable' style='text-align: center; margin-top:2%'>

                    <tr>
                        <th>ID</th>
                        <th>Subject Code</th>
                        <th>Class Name</th>
                        <th>Educator ID</th>
                        <th>Delete</th>
                    </tr>

                    @foreach($classSubject as $l)

                    <tr>
                        <td>
                            <h4> {{ $l->class_subject_id }} </h4>
                        </td>

                        <td>
                            <h4> {{ $l->subject_code }} </h4>
                        </td>

                        <td>
                            <h4> {{ $l->class_name }} </h4>
                        </td>

                        <td>
                            <h4> {{ $l->educator_id }} </h4>
                        </td>

                        <td>
                            <form action="{{route('deleteAssign')}}" method="post" class="form-group">
                                <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                                <input type='hidden' name='delete' value="{{ $l->class_subject_id }}">
                                <button class="button login_submit">
                                    <span class="button_text" onclick="return confirm('Are you sure? All Study Content Will Be Erased!')">Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @endforeach

                </table>
        </div>