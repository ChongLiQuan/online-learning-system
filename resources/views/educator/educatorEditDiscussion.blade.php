@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<?php
$edit_id = app('request')->input('edit_id');
$discussion = DB::table('discussion_list')->where('discussion_id', $edit_id)->get();
?>

@foreach($discussion as $a)

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('previous_url')}}">Go Back</a>
    </b>
</div>
<center>
    <img src="{{URL::asset('/images/discussion_logo.png')}}" height='50px' width='50px' />
    <h3>Edit Existing Discussion Information</h3>
    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    <br />

    <form action="{{route('editDiscussion')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
        <input type="hidden" name="edit_id" value="{{ $a->discussion_id }}"> @csrf

        <br />Content Title:
        <input type="text" name="discussion_title" class="subject_folder_name" value="{{ $a->discussion_title}}" placeholder="Content Name" autocomplete="off" align='left' size='40%' required>
        <br />
        <br />Subject Code:
        <input type="text" name="subject_code" class="folder_subject_code" value="{{ Session::get('current_subject_code')}}" autocomplete="off" align='left' size='40%' disabled>

        <br />
        <br />Class Name:
        <input type="text" name="class_name" class="folder_class_name" value="{{ Session::get('current_class_name')}}" autocomplete="off" align='left' size='40%' disabled>

        <br />
        <br />Sub-Folder of:
        <select name='subject_folder_id'>
            <option name="subject_folder_id" value="0">None</option>
            @foreach($list as $s)
            <option <?php if ($s->subject_folder_id == $a->subject_folder_id) {
                        echo ("selected");
                    } ?> name="subject_folder_id" value="{{ $s->subject_folder_id }}">{{ $s->subject_folder_name  }}</option>
            @endforeach
        </select>

        <br />
        <br />Student Reply:
        <select name='student_reply'>
            <option name="student_reply" value="1" <?php if ($a->discussion_student_subcomment == 1) {
                                                        echo "selected";
                                                    } ?>>Allow Reply</option>
            <option name="student_reply" value="0" <?php if ($a->discussion_student_subcomment == 0) {
                                                        echo "selected";
                                                    } ?>>Not Allow Reply</option>
        </select>

        Student Edit:
        <select name='student_edit'>
            <option name="student_edit" value="1" <?php if ($a->discussion_student_edit == 1) {
                                                        echo "selected";
                                                    } ?>>Allow Edit</option>
            <option name="student_edit" value="0" <?php if ($a->discussion_student_edit == 0) {
                                                        echo "selected";
                                                    } ?>>Not Allow Edit</option>
        </select>

        <br />
        <div class='editor_container'>
            <textarea name="discussion_content" id="editor">{{ $a->discussion_content }}</textarea>
        </div>

        <button class="button submit">
            <span class="button_text">Edit Now</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>
    @endforeach

    </div>

    @include('ckEditor')