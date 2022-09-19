@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_course_url') }}">Go Back</a>
    </b>
</div>
<center>
    <img src="{{URL::asset('/images/discussion_logo.png')}}" height='50px' width='50px' />
    <h3>Add a New Discussion</h3>
    <br />

    <form action="{{route('addDiscussion')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

        <input type="hidden" name="discussion_educator" value="{{ Session::get('username') }}">
        <input type="text" name="discussion_title" class="subject_folder_name" placeholder="Discussion Title" autocomplete="off" align='left' size='40%' required>
        <br />
        <br />Subject Code:
        <input type="text" name="subject_code" class="folder_subject_code" value="{{ Session::get('current_subject_code')}}" autocomplete="off" align='left' size='40%' disabled>

        <br />
        <br />Class Name:
        <input type="text" name="class_name" class="folder_class_name" value="{{ Session::get('current_class_name')}}" autocomplete="off" align='left' size='40%' disabled>

        <br />
        <br />Insert into Folder:
        <select name='subject_folder_id' required>
            <option name="subject_folder_id" selected disabled>None</option>
            @foreach($list as $s)
            <option name="subject_folder_id" value="{{ $s->subject_folder_id }}">{{ $s->subject_folder_name  }}</option>
            @endforeach
        </select>

        <br />
        <br />Student Reply:
        <select name='student_reply'>
            <option name="student_reply" value="1">Allow Reply</option>
            <option name="student_reply" value="0">Not Allow Reply</option>
        </select>

        Student Edit:
        <select name='student_edit'>
            <option name="student_edit" value="1">Allow Edit</option>
            <option name="student_edit" value="0">Not Allow Edit</option>
        </select>


        @if (session('pass_status'))
        <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
        @endif

        @if (session('error_status'))
        <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
        @endif

        <br />
        <div class='editor_container'>
            <textarea name="discussion_content" id="editor"></textarea>
        </div>

        <button class="button submit">
            <span class="button_text">Add Discussion</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>

    </div>

    @include('tinyEditor')
