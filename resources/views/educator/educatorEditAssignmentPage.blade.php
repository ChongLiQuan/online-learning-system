<?php
$edit_id = app('request')->input('edit_id');
$assignment = DB::table('assignment_list')->where('assignment_id', $edit_id)->get();
?>

@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_course_url') }}">Go Back</a>
    </b>
</div>
<center>
    <img src="{{URL::asset('/images/assignment_logo.png')}}" height='50px' width='50px' />
    <h3>Edit on Existing Assignment For <u> {{ Session::get('current_subject_code') }} {{ Session::get('current_class_name')}}</u></h3>
    <br />

    @foreach($assignment as $a)
    <form action="{{route('editAssignment')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

        <input type="hidden" name="edit_id" value="{{ $edit_id }}">

        <label>Assignment Title:</label>
        <input type="text" name="assignment_title" placeholder="Assignment Title" value="{{ $a->assignment_title }}" autocomplete="off" align='left' size='30%' required>

        <br /> <br />
        <label>Assignment Due Date:</label>
        <?php $current_date_time = date('Y-m-d H:i'); ?>
        <input type="datetime-local" name="assignment_due_date" placeholder="Full Marks" value="{{ $a->assignment_due_date }}" autocomplete="off" align='left' size='30%' min='{{ $current_date_time }}' required>

        <br /> <br />
        <label>Assignment Full Marks:</label>
        <input type="number" name="assignment_full_mark" placeholder="1" autocomplete="off" value="{{ $a->assignment_full_mark }}" align='left' size='50%' min='1' max="100" required>

        <br />
        <br />Insert into Folder:
        <select name='assignment_folder' required>
            @foreach($list as $s)
            <option name="assignment_folder" value="{{ $s->subject_folder_id }}" <?php if($s->subject_folder_id == $a->subject_folder_id) echo"selected" ?>>{{ $s->subject_folder_name  }}</option>
            @endforeach
        </select>


        @if (session('pass_status'))
        <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
        @endif

        @if (session('error_status'))
        <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
        @endif

        <br />
        <div class='editor_container'>
            <textarea name="assignment_content" id="editor">{{ $a->assignment_content }}</textarea>
        </div>

        <button class="button submit">
            <span class="button_text">Edit Assignment</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>

    </div>
    @endforeach

    @include('tinyEditor')