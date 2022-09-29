@include('student/studentHeader')
@include('student/studentRightSideBar')
@include('student/studentLeftSideBar')

<article id="mainArticle">
    <p class='stu_home_banner'><b>Recycler Bin</b></p>
    <p style='color:#FF8C00;'>*Student please keep in mind that, note deleted will be removed from the system database permanently. Please think twice before performing the delete action.</p>
    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    <hr>

    <!-- Display Deleted Folders Table -->
    <p><b class='stu_home_banner'>Deleted Notes</b></p>

    <table class='student_folder_table' border=1>
        <colgroup>
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 15%;">
            <col span="1" style="width: 15%;">
        </colgroup>

        <tr>
            <th>
                ID
            </th>
            <th>
                Deleted Note Name
            </th>
            <th>
                Will Be Deleted Date
            </th>
            <th>
                Preview
            </th>
            <th>
                Recover
            </th>
            <th>
                Delete
            </th>
        </tr>

        @foreach($notes as $f)

        <td>
            <p>{{$f->student_note_id}}</p>
        </td>
        <td>
            <center>
                <a href="{{ route('studentViewNote', ['student_note_id' => $f->student_note_id]) }}">
                    <p>{{$f->student_note_name}}</p>
                </a>
            </center>
        </td>
        <td>
            <p>{{$f->deleted_date}}</p>
        </td>
        <td>
            <button class="preview_folder_button">
                <a href="{{ route('studentViewNote', ['student_note_id' => $f->student_note_id]) }}">
                    <span class="button_text">Preview</span></a>
            </button>
        </td>
        <td>
            <form action="{{route('recoverStudentNote')}}" method="post" class="form-group">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                <input type="hidden" name="recover_id" value="{{ $f->student_note_id }}">

                <button class="add_folder_button" onclick="return confirm('Do you wish to recover this note?')">
                    <span class="button_text">Recover</span>
                </button>
            </form>
        </td>
        <td>
            <form action="{{route('studentPermanentDeletedNote')}}" method="post" class="form-group">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                <input type="hidden" name="delete_id" value="{{ $f->student_note_id }}">

                <button class="delete_folder_button" onclick="return confirm('Are you sure? Deleted notes will be removed forever.')">
                    <span class="button_text">Delete</span>
                </button>
            </form>
        </td>
        </tr>

        @endforeach
    </table>

</article>
