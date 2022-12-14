@include('student/studentHeader')
@include('student/studentRightSideBar')
@include('student/studentLeftSideBar')
<?php
$folder_id = Session::get('current_student_folder_id');
Session::put('previous_folder_page', URL::current());
$active_status = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_folder_id', $folder_id)->pluck('active_status')->first();
?>

<article id="mainArticle">
    <table border=0 width=100%>
        <colgroup>
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 30%;">
            <col span="1" style="width: 30%;">
        </colgroup>
        <tr>
            <td>
                <p class='stu_home_banner'><b>Folder View of: [ {{ Session::get('current_student_folder_name')}} ]</b></p>
                <?php if ($active_status == 0) { ?>
                    <p style='color:#FF8C00;'>*Preview of a deleted folder*</p>
                <?php } ?>
            </td>

            <td>
                <?php if ($active_status == 1) { ?>
                    <!-- Validation: only activated status will be able to use edit button -->
                    <form action="{{route('studentEditFolderView', ['student_folder_id' =>  Session::get('current_student_folder_id') ])}}" method="post" class="form-group">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                        <p style="text-align: left;"> &nbsp;
                            <button class="add_folder_button">
                                <span class="button_text">Rename Current Folder</span></a>
                            </button>
                    </form>
                <?php } ?>
            </td>

            <td>
                <?php if ($active_status == 1) { ?>
                    <form action="{{route('deleteStudentFolder')}}" method="post" class="form-group">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

                        <input type="hidden" name="delete_id" value="{{ Session::get('current_student_folder_id') }}">

                        <p style="text-align: right;"> &nbsp;
                            <button class="delete_folder_button">
                                <span class="button_text" onclick="return confirm('Are you sure?')">Delete Folder</span></a>
                            </button>
                        </p>
                    </form>
                <?php } ?>
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

        <?php
        if ($active_status == 1) { ?>
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
        
        <!-- Else case for deleted folders -->
        <?php } else { ?>
            @foreach($deleted_folders as $f)
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

        @foreach($deleted_notes as $n)
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
        <?php } ?>

       
    </table>
</article>
