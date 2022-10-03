@include('student/studentHeader')

@include('courseSideBar')
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<article id="mainArticle">

    @foreach($submissions as $s)
    @foreach($assignment as $a)

    <center>
        <p class='stu_home_banner'><b>Assignment Submission Portal : {{ $a->assignment_title }}</b></p>
        <p>Assignment has been submitted. Please wait for the educator to release the final mark.</p>

        <hr>
        <br><br>

    </center>
    <table class='student_assignment' border=0>
        <p><b>Assignment Details:</b></p>
        <tr>
            <td>
                <?php $student_name = DB::table('student_list')->where('student_id', $s->student_id)->pluck('student_name')->first(); ?>
                <p>Submitted by: {{ $student_name }}
            </td>
            <td>
                <p>Total Marks: {{ $s->submission_mark }} / {{ $a->assignment_full_mark }} </p>
            </td>
        </tr>
    </table>
    <br><br>

    <table class='student_assignment' border=1>
        <tr>
            <td colspan="2">
                <p>{!! $s->submission_content !!}</p>
            </td>
        </tr>

        @endforeach
        @endforeach
    </table>


    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    </form>

</article>

@include('tinyEditor');