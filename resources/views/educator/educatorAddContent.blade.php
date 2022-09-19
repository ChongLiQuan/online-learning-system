@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_course_url') }}">Go Back</a>
    </b>
</div>
<center>
    <img src="{{URL::asset('/images/paper_logo.png')}}" height='50px' width='50px' />
    <h3>Add a New Content</h3>
    <br />

    <form action="{{route('addContent')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

        <input type="text" name="content_title" class="subject_folder_name" placeholder="Content Name" autocomplete="off" align='left' size='40%' required>
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


        @if (session('pass_status'))
        <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
        @endif

        @if (session('error_status'))
        <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
        @endif

        <br />
        <div class='editor_container'>
            <textarea name="content" id="editor"></textarea>
        </div>

        <button class="button submit">
            <span class="button_text">Add Content</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>

    </div>

    @include('tinyEditor')
