@if(Session::get('user_role') == 1)
@include('educator/educatorHeader')
@endif

@if(Session::get('user_role') == 2)
@include('student/studentHeader')
@endif

<?php Session::put('previous_url', URL::current()); ?>
<link rel="icon" href="{!! asset('educator/images/login_logo.jpeg') !!}" />
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

@include('courseSideBar')

<article id="mainArticle">

    @if(Session::get('user_role') == 1)
    <p class='edu_home_banner'><b>Student Note </b></p>
    @endif

    @if(Session::get('user_role') == 2)
    <p class='stu_home_banner'><b>Class Hall</b></p>
    @endif

    @if (session('delete_status'))
    <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
    @endif

    <hr>
    @foreach($note as $n)
    <?php $author = DB::table('student_list')->where('student_id', $n->student_id)->pluck('student_name')->first();
    ?>
    <p>Note By: {{ $author }} </p>
    <table class='folder' border=0>
        <tr>
            <th>
                {!! $n->student_note_content !!}
            </th>
        </tr>
    </table>
    <hr>
    @endforeach
</article>


<script>
    var msg = '{{Session::get('
    alert ')}}';
    var exist = '{{Session::has('
    alert ')}}';
    if (exist) {
        alert(msg);
    }
</script>