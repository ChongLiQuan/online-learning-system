@if(Session::get('user_role') == 1)
@include('educator/educatorHeader')
@endif

@if(Session::get('user_role') == 2)
@include('student/studentHeader')
@endif
<?php
$edit_id = app('request')->input('edit_id');
$comment = DB::table('comment_list')->where('comment_id', $edit_id)->get();
?>

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_discussion_url')}}">Go Back</a>
    </b>
</div>
<center>
    <img src="{{URL::asset('/images/discussion_logo.png')}}" height='50px' width='50px' />
    <h3>Add Comment / Reply</h3>
    <br />

    @foreach($comment as $c)
    <form action="{{route('editComment')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

        <input type="hidden" name="comment_username" value="{{ Session::get('username') }}">
        <input type="hidden" name="comment_id" value="{{ $c->comment_id }}">
        <br />Comment Title:
        <input type="text" name="comment_title" class="subject_folder_name" placeholder="Comment Title" value="{{ $c->comment_title }}" autocomplete="off" align='left' size='40%' required>
        @if (session('pass_status'))
        <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
        @endif

        @if (session('error_status'))
        <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
        @endif

        <br />
        <div class='editor_container'>
            <textarea name="comment_content" id="editor">{{ $c->comment_content }}</textarea>
        </div>

        <button class="button submit">
            <span class="button_text">Edit Comment</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>

    </div>
    @endforeach

    @include('ckEditor')