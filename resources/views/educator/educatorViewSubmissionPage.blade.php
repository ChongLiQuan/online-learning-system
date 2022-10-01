<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

@include('educator/educatorHeader')
@include('courseSideBar')

<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<article id="fullArticle">
    <center>

        <p class='edu_home_banner'><b>Assignment Submission Portal : </b></p>
        @foreach($assignment as $a)
        <p>Currently Viewing: {{ $a->assignment_title }} Student Submission Name List</p>
        @endforeach

        <!-- Educator to view total submission and total student in the class of the assignment -->
        <!-- <p> {{ $totalSubmission }} / {{ $totalStudent }} </p> -->

        <table class='assignment_list' border=0>
            <colgroup>
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 50%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 20%;">
            </colgroup>

            <thead>
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
                    Mark Status
                </th>
                <th>
                    View Submission
                </th>
            </thead>

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
                <?php if ($s->submission_mark != NULL) { ?>
                    <td style="color:green">
                        Marked
                    </td>
                <?php } ?>
                <?php if ($s->submission_mark == NULL) { ?>
                    <td style="color:red">
                        Not Yet Marked
                    </td>
                <?php } ?>
                <td>
                    <!-- Unmarked assignment will be displayed with the option to mark the assignment  -->
                    <?php if ($s->submission_mark == NULL) { ?>
                        <a href="{{ route('educatorMarkAssignmentPage', ['submission_id' => $s->submission_id]) }}">Mark Now
                        <?php } ?>
                        <!-- Marked assignment will be displayed with the option to edit the assignment mark or comment -->
                        <?php if ($s->submission_mark != NULL) { ?>
                            <a href="{{ route('educatorRemarkAssignmentPage', ['submission_id' => $s->submission_id]) }}">Edit Mark
                            <?php } ?>
                </td>
            </tr>
            @endforeach
        </table>

    </center>
</article>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('.assignment_list').DataTable({
        searching: true,
        ordering: false,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "ALL"]
        ]
    });
</script>