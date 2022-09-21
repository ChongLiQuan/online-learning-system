@include('student/studentHeader')

<?php Session::put('current_edit_note_url', URL::current()) ?>

<article id="mainArticle">
    <p><b><a href="/studentHomepage">Go Back</a></b></p>
    <hr>
    <center>
        @foreach($note as $n)
        <h3>Edit on Existing Note</h3>
        <br />

        <form action="{{ route('studentEditNote') }}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
            <input type="hidden" name="student_note_id" value="{{ $n->student_note_id }}">
            <input type="text" name="student_note_name" value="{{ $n->student_note_name }}" class="student_input_note_name" placeholder="Note Title" autocomplete="off" align='left' required>

            <label>Choose a Subject:</label>
            <select name='student_note_subject'>
                <option name="student_note_subject" value="">None</option>
                @foreach($subjects as $s)
                <option name="student_note_subject" <?php if ($s->class_subject_id == $n->student_note_subject_id) echo "selected" ?> value="{{ $s->class_subject_id  }}">{{ $s->subject_code  }}</option>
                @endforeach
            </select>

            <label>Choose a Folder:</label>
            <select name='student_note_subFolder'>
                @foreach($folders as $f)
                <option name="student_note_subFolder" <?php if ($f->student_folder_id == $n->student_note_subFolder) echo "selected" ?> value="{{ $f->student_folder_id }}">{{ $f->student_folder_name }}</option>
                @endforeach
            </select>

            <label>Share with Class:</label>
            <select name='share_status'>
                <?php Session::put('previous_share_status', $n->share_status) ?>
                <option name="share_status" <?php if ($n->share_status == 0) echo "selected" ?> value="0">No</option>
                <option name="share_status" <?php if ($n->share_status == 1) echo "selected" ?> value="1">Yes</option>
            </select>

            <div class='editor_container'>
                <textarea name="student_note_content" id="editor">{{ $n->student_note_content }}</textarea>
            </div>

            @if (session('pass_status'))
            <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
            @endif

            @if (session('error_status'))
            <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
            @endif

            <button class="button submit">
                <span class="button_text">Update Note Now</span>
                <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
            </button>
        </form>
        @endforeach

        </div>
</article>

@include('student/studentSidebar')
@include('tinyEditor')