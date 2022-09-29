@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_course_url') }}">Go Back</a>
    </b>
</div>
<center>
    <img src="{{URL::asset('/images/assignment_logo.png')}}" height='50px' width='50px' />
    <h3>Add a New Assignment For <u> {{ Session::get('current_subject_code') }} {{ Session::get('current_class_name')}}</u></h3>
    <br />

    <form action="{{route('addAssignment')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

        <label>Assignment Title:</label>
        <input type="text" name="assignment_title" placeholder="Assignment Title" autocomplete="off" align='left' size='30%' required>

        <br /> <br />
        <label>Assignment Due Date:</label>
        <?php $current_date_time = \Carbon\Carbon::now()->toDateString(); ?>
        <input type="datetime-local" name="assignment_due_date" placeholder="Full Marks" autocomplete="off" align='left' value="{{ $current_date_time }}" size='30%' min='{{ $current_date_time }}' max='018-12-31' required>

        <br /> <br />
        <label>Assignment Full Marks:</label>
        <input type="number" name="assignment_full_mark" placeholder="1" autocomplete="off" align='left' size='50%' min='1' max="100" required>

        <br />
        <br />Insert into Folder:
        <select name='assignment_folder' required>
            @foreach($list as $s)
            <option name="assignment_folder" value="{{ $s->subject_folder_id }}">{{ $s->subject_folder_name  }}</option>
            @endforeach
        </select>

        <br />
        <br />Email Alert:
        <select name='assignment_email_educator_status' required>
            <option name="assignment_email_educator_status" value="0">No</option>
            <option name="assignment_email_educator_status" value="1">Yes</option>
        </select>

        @if (session('pass_status'))
        <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
        @endif

        @if (session('error_status'))
        <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
        @endif

        <br />
        <div class='editor_container'>
            <textarea name="assignment_content" id="editor" placeholder="Assignment content...."></textarea>
        </div>

        <button class="button submit">
            <span class="button_text">Release Assignment</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>

    </div>

    @include('tinyEditor')