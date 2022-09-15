@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:100px;"> <a href="{{ Session::get('current_course_url') }}">Go Back</a>
    </b>
    <center>
        <img src="{{URL::asset('/images/announcement_logo.png')}}" height='50px' width='50px' />
        <h3>Make An Announcement</h3>
        <br />

        <form action="{{route('addAnnouncement')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

            <input type="hidden" name="annouce_edu" value=" {{ Session::get('user_full_name') }}">
            <input type="text" name="annouce_title" class="announcement_title" placeholder="Annonucement Title" autocomplete="off" align='left' size='40%' required>
            <label>Choose a Subject:</label>

            <select name='annouce_subject'>
                @foreach($subjects as $s)
                <option name="annouce_subject" value="{{ $s->subject_code }}">{{ $s->subject_code  }}</option>
                @endforeach
            </select>

            <label>Choose a Class:</label>

            <select name='annouce_class'>
                @foreach($classes as $s)
                <option name="annouce_class" value="{{ $s->class_name }}">{{ $s->class_name  }}</option>
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

@include('ckEditor')