@include('educator/educatorHeader')
<link rel="icon" href="{!! asset('educator/images/login_logo.jpeg') !!}" />
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">


<article id="mainArticle"><b>Article</b>

</article>



<nav id="mainNav_courseHome">
    <br />   

    @foreach($subjects as $s)
    <?php $course_name = DB::table('subject_list')->where('subject_code', $s->subject_code)->pluck('subject_name')->first(); ?>

    <p><b>[{{$s->subject_code }}] {{$course_name}} ({{ $class_name }})</b></p>
    @endforeach

    <p><a href="">Course Home Page</a></p>
    <p><a href="/studyMaterial">Study Material</a></p>
    </p>

    <p><a href="/educatorAddAnnouncement">Make Announcement</a></p>
</nav>

<script>
    var msg = '{{Session::get('
    alert ')}}';
    var exist = '{{Session::has('
    alert ')}}';
    if (exist) {
        alert(msg);
    }
</script>