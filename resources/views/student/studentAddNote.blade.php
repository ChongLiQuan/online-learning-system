@include('student/studentHeader')

<article id="mainArticle">
    <p><b><a href="{{ url()->previous() }}">Go Back</a></b></p>
    <hr>
        <center>
            <img src="{{URL::asset('/images/student_note_logo.png')}}" height='50px' width='50px' />
            <h3>Write a New Note</h3>
            <br />

            <form action="{{route('addAnnouncement')}}" method="post" class="form-group">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

                <input type="hidden" name="annouce_edu" value=" {{ Session::get('username') }}">
                <input type="text" name="annouce_title" class="student_input_note_name" placeholder="Note Title" autocomplete="off" align='left' required>
                
                <label>Choose a Subject:</label>
                <select name='annouce_subject'>
                    @foreach($subjects as $s)
                    <option name="annouce_subject" value="{{ $s->subject_code }}">{{ $s->subject_code  }}</option>
                    @endforeach
                </select>

                <label>Choose a Folder:</label>
                <select name='annouce_subject'>
                    @foreach($folders as $f)
                    <option name="annouce_subject" value="{{ $f->student_folder_id }}">{{ $f->student_folder_name }}</option>
                    @endforeach
                </select>

                <div class='editor_container'>
                    <textarea name="annouce_content" id="editor"></textarea>
                </div>

                @if (session('pass_status'))
                <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
                @endif

                @if (session('error_status'))
                <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
                @endif

                <button class="button submit">
                    <span class="button_text">Publish Now</span>
                    <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
                </button>
            </form>

    </div>
</article>

@include('student/studentSidebar')
@include('ckEditor')
