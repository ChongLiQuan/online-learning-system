@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_course_url')}}">Go Back</a>
    </b>
</div>
<center>
    <img src="{{URL::asset('/images/discussion_logo.png')}}" height='50px' width='50px' />
    <h3>Add Comment / Reply</h3>
    <br />

    <form action="{{route('addComment')}}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
       
        <input type="hidden" name="comment_username" value="{{ Session::get('username') }}" >
        <input type="hidden" name="discussion_id" value="{{ request()->discussion_id }}">
        <br />Comment Title:
        <input type="text" name="comment_title" class="folder_name" placeholder="Comment Title" autocomplete="off" align='left' size='40%' required>
        @if (session('pass_status'))
        <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
        @endif

        @if (session('error_status'))
        <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
        @endif

        <br />
        <div class='editor_container'>
            <textarea name="comment_content" id="editor"></textarea>
        </div>

        <button class="button submit">
            <span class="button_text">Add Comment</span>
            <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
        </button>
    </form>

    </div>

    @include('ckEditor')