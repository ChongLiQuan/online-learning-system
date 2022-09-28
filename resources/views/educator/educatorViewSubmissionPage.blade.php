@include('educator/educatorHeader')
@include('courseSideBar')

<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<article id="mainArticle">
    <center>

        <p class='edu_home_banner'><b>Assignment Submission Portal : </b></p>
        @foreach($assignment as $a)
        <p>Currently Viewing: {{ $a->assignment_title }} Student Submission Name List</p>
        @endforeach

        <p> {{ $totalSubmission }} / {{ $totalStudent }} </p>

        <hr>
        <br><br>

        <table class='submission_list' border=1>
            <colgroup>
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 50%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 20%;">
            </colgroup>

            <tr>
                <th>
                    Number
                </th>
                <th>
                    Student Name
                </th>
                <th>
                    Submission Date
                </th>
                <th>
                    View Submission
                </th>
            </tr>

            @foreach($submission as $s)
            <tr>
                <td>
                    {{ $s->submission_id }}
                </td>
                <td>
                    <?php $student_name = DB::table('student_list')->where('student_id', $s->student_id)->pluck('student_name')->first(); ?>
                    {{ $student_name }}
                </td>
                <td>
                    {{ $s->submission_date }}
                </td>
                <td>
                    <a href>View</a>
                </td>
            </tr>
            @endforeach
        </table>

    </center>
</article>