@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_course_url')}}">Go Back</a>
    </b>
</div>
<center>
    <h3>Add a New Folder</h3>
    <br />

    <form action="{{route('addFolder')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

        <input type="text" name="folder_name" class="folder_name" placeholder="Folder Name" autocomplete="off" align='left' size='40%' required>
        <br />
        <br />Subject Code:
        <input type="text" name="subject_code" class="folder_subject_code" value="{{ Session::get('current_subject_code')}}" autocomplete="off" align='left' size='40%' disabled>

        <br />
        <br />Class Name:
        <input type="text" name="class_name" class="folder_class_name" value="{{ Session::get('current_class_name')}}" autocomplete="off" align='left' size='40%' disabled>

        <br />
        <br />Sub-Folder of:
        <select name='subFolder'>
            <option name="subFolder" value="0">None</option>
            @foreach($list as $s)
            <option name="subFolder" value="{{ $s->folder_id }}">{{ $s->folder_name  }}</option>
            @endforeach
        </select>

        <br />
        <div class='editor_container'>
            <textarea name="folder_content" id="editor"></textarea>
        </div>

        <?php
        $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('id')->first();
        ?>

        <input type="hidden" name="class_subject_id" value="{{ $class_subject_id }}">


        @if (session('pass_status'))
        <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
        @endif

        @if (session('error_status'))
        <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
        @endif

        <button class="button submit">
            <span class="button_text">Add Folder</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>

    </div>

    @include('ckEditor')