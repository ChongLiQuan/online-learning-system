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
    <p class='edu_home_banner'><b>Student Note Hall</b></p>
    @endif

    @if(Session::get('user_role') == 2)
    <p class='stu_home_banner'><b>Student Note Hall</b></p>
    @endif

    @if (session('delete_status'))
    <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
    @endif

    <hr>
    <table class='note_list' border=0>
        @foreach($note as $n)
        <tr>
            <colgroup>
                <col span="1" style="width: 5%;">
                <col span="1" style="width: 60%;">
                <col span="1" style="width: 30%;">
            </colgroup>

            <td width='5%'>
                <img src="{{URL::asset('/images/student_note_logo.png')}}" height='50px' width='50px' />
            </td>

            <td>
                <a href="{{ route('courseDisplayStudentNoteContentPage', ['student_note_id' => $n->student_note_id]) }}"> {{ $n->student_note_name }} </a>
            </td>

            <td>
                <?php $author = DB::table('student_list')->where('student_id', $n->student_id)->pluck('student_name')->first();
                ?>
                By: {{ $author }}
            </td>

            @if(Session::get('user_role') == 1)
            <td colspan="4" style='text-align:right'>
                <form action="{{route('educatorUnshareNote')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                    <input type='hidden' name='note_id' value="{{ $n->student_note_id  }}">
                    <button class="button delete_button" onclick="return confirm('Are you sure to unshare this note?')">Unshare</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </table>
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