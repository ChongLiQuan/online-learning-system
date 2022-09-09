@include('student/studentHeader')

<article id="mainArticle">
    <p><b>Rename Folder</b></p>

    <!-- Add New Note Folder -->

    <hr>

    <table border=0 width='30%'>
        <colgroup>
            <col span="1" style="width: 2%;">
            <col span="1" style="width: 28%;">
        </colgroup>
        <tr>
            <td>
                <img src="{{URL::asset('/images/edit_folder.png')}}" height='50px' width='50px' />
            </td>
            <td>
                <p><b><u>Please enter a new folder name:</u></b></p>
            </td>
        </tr>
    </table>

    <form action="{{route('editStudentFolder')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
        @foreach($folder_edit as $edit)

        <table class="student" border=0>

            <colgroup>
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 10%;">
            </colgroup>

            <tr>
                <td>
                    <input type="text" name="student_folder_name" class="student_input" placeholder="Rename Folder Title" autocomplete="off" value="{{ $edit->student_folder_name }}" required>
                </td>

                <td style="text-align:right;">
                    Sub-Folder of:
                    <select name='student_subFolder'>
                        @foreach($folders_dropdown as $f)
                        <option name="subject_subFolder" <?php if ($edit->student_subFolder == $f->student_subFolder) echo "selected" ?> value="{{ $f->student_folder_id }}">{{ $f->student_folder_name  }}</option>
                        @endforeach
                        <option <?php if ($edit->student_subFolder  == NULL) echo "selected" ?> name="student_subFolder" value="">None</option>
                    </select>
                </td>

                <td>
                    <button class="add_folder_button">
                        <span class="button_text">Confirm Rename</span>
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

        <p>Current Editing Folder Name is: {{ Session::get('current_student_folder_name')}}</p>

        <br>
        <hr>
        @endforeach
    </form>


</article>

@include('student/studentSidebar')