@include('student/studentHeader')

<?php $folder_id = Session::get('current_student_folder_id');
      Session::put('previous_folder_page', URL::current());  ?>

<article id="mainArticle">
    <table border=0 width=100%>
        <colgroup>
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 30%;">
            <col span="1" style="width: 30%;">
        </colgroup>
        <tr>
            <td>
                <p><b>Folder View of: [ {{ Session::get('current_student_folder_name')}} ]</b></p>
            </td>

            <td>
                <form action="{{route('studentEditFolderView', ['student_folder_id' =>  Session::get('current_student_folder_id') ])}}" method="post" class="form-group">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                    <p style="text-align: left;"> &nbsp;
                        <button class="add_folder_button">
                            <span class="button_text">Rename Current Folder</span></a>
                        </button>
                </form>
            </td>

            <td>
                <form action="{{route('deleteStudentFolder')}}" method="post" class="form-group">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

                    <input type="hidden" name="delete_id" value="{{ Session::get('current_student_folder_id') }}">

                    <p style="text-align: right;"> &nbsp;
                        <button class="delete_folder_button">
                            <span class="button_text" onclick="return confirm('Are you sure?')">Delete Folder</span></a>
                        </button>
                    </p>
                </form>
            </td>
        </tr>
    </table>

    <!-- Add New Note Folder -->
    <hr>

    <p><b>Sub-folders</b></p>

    <table class='student_folder_table' border=0>
        <colgroup>
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
        </colgroup>

        <?php $counter = 0; ?>

        @foreach($folders as $f)
        @if($counter%5 == 0)
        <tr>
            @endif

            <td>
                <center>
                    <img src="{{URL::asset('/images/notes_taking_logo.png')}}" height='50px' width='50px' />
                    <a href="{{ route('studentFolderContent', ['student_folder_id' => $f->student_folder_id]) }}">
                        <p>{{$f->student_folder_name}}</u>
                    </a>
                    <?php $counter++ ?>
                </center>
            </td>

            @if($counter%5 == 0)
        </tr>
        @endif

        @endforeach
    </table>

    <hr>

    <p><b>Notes</b></p>

    <table class='student_folder_table' border=0>
        <colgroup>
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
        </colgroup>

        <?php $counter = 0; ?>

        @foreach($notes as $n)
        @if($counter%5 == 0)
        <tr>
            @endif

            <td>
                <center>
                    <img src="{{URL::asset('/images/student_note_logo.png')}}" height='50px' width='50px' />
                    <a href="{{ route('studentViewNote', ['student_note_id' => $n->student_note_id]) }}">
                        <p>{{ $n->student_note_name }}</p>
                    </a>
                    <?php $counter++ ?>
                </center>
            </td>

            @if($counter%5 == 0)
        </tr>
        @endif

        @endforeach
    </table>
</article>

@include('student/studentSidebar')