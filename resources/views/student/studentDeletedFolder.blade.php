@include('student/studentHeader')

<article id="mainArticle">
    <p class='stu_home_banner'><b>Recycler Bin</b></p>
    <p style='color:#FF8C00;'>*Student please keep in mind that, if the folder has sub-folders or notes, it will all be recover together if the main folder is being recover. Note that deleted folder will be removed from the system database permanently, please think twice.</p>
    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    <hr>

    <!-- Display Deleted Folders Table -->
    <table>
        <tr>
            <td>
                <img src="{{URL::asset('/images/notes_taking_logo.png')}}" height='50px' width='50px' />
            </td>
            <td>
                <p><b class='stu_home_banner'>Deleted Folder</b></p>
            </td>
        </tr>
    </table>

    <table class='student_folder_table' border=1>
        <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 25%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 15%;">
            <col span="1" style="width: 15%;">
            <col span="1" style="width: 15%;">
        </colgroup>

        <tr>
            <th>
                ID
            </th>
            <th>
                Deleted Folder Name
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

        @foreach($folders as $f)

        <td>
            <p>{{$f->student_folder_id}}</p>
        </td>
        <td>
            <center>
                <p>{{$f->student_folder_name}}</p>
            </center>
        </td>
        <td>
            <p>{{$f->deleted_date}}</p>
        </td>
        <td>
            <button class="preview_folder_button">
                <a href="{{ route('studentFolderContent', ['student_folder_id' => $f->student_folder_id]) }}">
                    <span class="button_text">Preview</span></a>
            </button>
        </td>
        <td>
            <form action="{{route('recoverStudentFolder')}}" method="post" class="form-group">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                <input type="hidden" name="recover_id" value="{{ $f->student_folder_id }}">

                <button class="add_folder_button" onclick="return confirm('Do you wish to recover this folder?')">
                    <span class="button_text">Recover</span>
                </button>
            </form>
        </td>
        <td>
            <form action="{{route('permanentDeleteStudentFolder')}}" method="post" class="form-group">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                <input type="hidden" name="delete_id" value="{{ $f->student_folder_id }}">

                <button class="delete_folder_button" onclick="return confirm('Are you sure? Deleted notes will be removed forever.')">
                    <span class="button_text">Delete</span>
                </button>
            </form>
        </td>
        </tr>

        @endforeach
    </table>
</article>

@include('student/studentSidebar')