@include('educator/educatorHeader')

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<div class='fullContent'>
    <center>
        <h3>Make An Annoucement</h3>
        <br />

        <form action="{{route('addAnnoucement')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

            <input type="hidden" name="annouce_edu" value=" {{ Session::get('username') }}">
            <input type="text" name="annouce_title" class="annoucement_title" placeholder="Annoucement Title" autocomplete="off" align='left' size='40%' required>
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

            <div class="form-group">
                <textarea class="ckeditor form-control" name="annouce_content"></textarea>
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


<script type="text/javascript">

    CKEDITOR.replace('annouce_content', {
        filebrowserUploadUrl: "{{route('uploadImage', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

</script>

