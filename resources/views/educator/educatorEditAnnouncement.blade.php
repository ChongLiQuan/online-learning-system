@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <center>
        <img src="{{URL::asset('/images/announcement_logo.png')}}" height='50px' width='50px' />
        <h3>Edit An Announcement</h3>
        <br />
        <?php
        $edit_id = app('request')->input('edit_id');
        $announcement = DB::table('announcement_list')->where('annouce_id', $edit_id)->get();
        ?>


        @foreach($announcement as $a)

        <form action="{{route('editAnnouncement')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

            <input type="hidden" name="edit_id" value=" {{ $a->annouce_id }}">
            <input type="text" name="annouce_title" value="{{ $a->annouce_title }}" class="announcement_title" placeholder="Annonucement Title" autocomplete="off" align='left' size='40%' required>
            <label>Choose a Subject:</label>

            <select name='annouce_subject'>
                @foreach($subjects as $s)
                <option <?php if ($s->subject_code == $a->annouce_subject) {
                            echo ("selected");
                        } ?> name="annouce_subject" value="{{ $s->subject_code }}">{{ $s->subject_code }}</option>
                @endforeach
            </select>

            <label>Choose a Class:</label>

            <select name='annouce_class'>
                @foreach($classes as $c)
                <option <?php if (($c->class_name) == $a->annouce_class) {
                            echo ("selected");
                        } ?> name="annouce_class" value="{{ $c->class_name }}">{{ $c->class_name }}</option>
                @endforeach
            </select>

            <div class='editor_container'>
                <textarea name="annouce_content" id="editor"> {{ $a->annouce_content}} </textarea>
            </div>

            @if (session('pass_status'))
            <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
            @endif

            @if (session('error_status'))
            <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
            @endif

            <button class="button submit">
                <span class="button_text">Edit Now</span>
                <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
            </button>
        </form>
        @endforeach
</div>

@include('ckEditor')