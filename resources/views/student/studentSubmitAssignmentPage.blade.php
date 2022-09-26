@include('student/studentHeader')

@include('courseSideBar')
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<article id="mainArticle">

    @foreach($assignment as $a)
    <center>
        <p class='stu_home_banner'><b>Assignment Submission Portal : {{ $a->assignment_title }}</b></p>

        <form action="{{route('submitAssignment')}}" method="POST" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

            <input type="hidden" name="assignment_id" value="{{ $a->assignment_id }}"> 

            <div class='editor_container'>
                <textarea name="assignment_content" id="editor"></textarea>
            </div>

            @if (session('pass_status'))
            <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
            @endif

            @if (session('error_status'))
            <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
            @endif

            <p>Assignment Full Marks: {{ $a->assignment_full_mark }}</p>
            <p style='color:#FF8C00;'>Please make sure you attach the right folder and use proper naming for the file.</p>


            <button class="button submit">
                <span class="button_text"  onclick="return confirm('Confirm Submission? Please make sure you attach the right file.')"/>Submit Assignment</span>
                <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
            </button>
        </form>


        @endforeach

</article>

@include('tinyEditor');