@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<?php
$edit_id = app('request')->input('edit_id');
$folder = DB::table('subject_folder_list')->where('subject_folder_id', $edit_id)->get();
?>

@foreach($folder as $a)

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_course_url')}}">Go Back</a>
    </b>
</div>
<center>
    <h3>Edit Existing Folder Information</h3>
    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    <br />

    <form action="{{route('editFolder')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
        <input type="hidden" name="edit_id" value="{{ $a->subject_folder_id }}"> @csrf

        <input type="text" name="subject_folder_name" class="subject_folder_name" value="{{ $a->subject_folder_name}}" placeholder="Folder Name" autocomplete="off" align='left' size='40%' required>
        <br />
        <br />Subject Code:
        <input type="text" name="subject_code" class="folder_subject_code" value="{{ Session::get('current_subject_code')}}" autocomplete="off" align='left' size='40%' disabled>

        <br />
        <br />Class Name:
        <input type="text" name="class_name" class="folder_class_name" value="{{ Session::get('current_class_name')}}" autocomplete="off" align='left' size='40%' disabled>

        <br />
        <br />Sub-Folder of:
        <select name='subject_subFolder'>
            <option name="subject_subFolder" value="0">None</option>
            @foreach($list as $s)
            <option <?php if ($s->subject_folder_id == $a->subject_subFolder){
                        echo ("selected");
                    } ?> name="subject_subFolder" value="{{ $s->subject_folder_id }}" >{{ $s->subject_folder_name  }}</option>
            @endforeach
        </select>

        <br />
        <div class='editor_container'>
            <textarea name="subject_folder_content" id="editor">{{ $a->subject_folder_content }}</textarea>
        </div>

        <button class="button submit">
            <span class="button_text">Edit Now</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>
    @endforeach

    </div>

    @include('tinyEditor')
