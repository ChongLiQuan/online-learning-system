@include('student/studentHeader')
@include('student/studentSidebar')

<article id="mainArticle">
    <p class='stu_home_banner'><b>Notes Taking</b></p>

    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    <!-- Add New Note Folder -->

    <hr>

    <table border=0 width='30%'>
        <colgroup>
            <col span="1" style="width: 2%;">
            <col span="1" style="width: 28%;">
        </colgroup>
        <tr>
            <td>
                <img src="{{URL::asset('/images/notes_taking_logo.png')}}" height='50px' width='50px' />
            </td>
            <td>
                <p><b><u>Create New Note Folder</u></b></p>
            </td>
        </tr>
    </table>

    <form action="{{route('addStudentFolder')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

        <table class="student" border=0>

            <colgroup>
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 10%;">
            </colgroup>

            <tr>
                <td>
                    <input type="text" name="student_folder_name" class="student_input" placeholder="Folder Title" autocomplete="off" required>
                </td>

                <td style="text-align:right;">
                    Sub-Folder of:
                    <select name='student_subFolder'>
                        <option name="student_subFolder" value="">None</option>
                        @foreach($folders_dropdown as $f)
                        <option name="subject_subFolder" value="{{ $f->student_folder_id }}">{{ $f->student_folder_name  }}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <button class="add_folder_button">
                        <span class="button_text">Add Folder</span>
                        <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        </table>

        @if (session('pass_folder_status'))
        <p style="text-align:center; color:green;"><b>{{ session('pass_folder_status') }}</b></p>
        @endif

        @if (session('error_folder_status'))
        <p style="text-align:center; color:red;"><b>{{ session('error_folder_status') }}</b></p>
        @endif

        <br>
        <hr>
    </form>

    <!-- Add Note Form -->
    <table border=0 width='30%'>
        <colgroup>
            <col span="1" style="width: 2%;">
            <col span="1" style="width: 28%;">
        </colgroup>

        <tr>
            <td>
                <img src="{{URL::asset('/images/student_note_logo.png')}}" height='50px' width='50px' />
            </td>
            <td>
                <p><b><u>Create New Notes</u></b></p>
            </td>
        </tr>

        <tr>
            <td></td>
            <td style="text-align: left;"> &nbsp;
                <button class="add_folder_button">
                    <a href="studentAddNote">
                        <span class="button_text">Write New Note</span></a>
                </button>
                </form>
            </td>
        </tr>
    </table>

    <br>
    <hr>

    <!-- Display Folders Category Table -->

    <p class='stu_home_banner'><b>Notebook Category</b></p>

    <div class='student_folder_scrollable'>

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
    </div>
    <hr>
</article>
