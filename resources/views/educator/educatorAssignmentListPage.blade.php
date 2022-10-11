<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

@include('educator/educatorHeader')
@include('educator/educatorHomeSideBar')
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<article id="fullArticle">
    <p class='edu_home_banner'><b>Assignment Submission Portal List Page</b></p>
    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    <table class="assignment_list">
        <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 5%;">
        </colgroup>

        <thead>
            <th>
                ID
            </th>
            <th>
                Assignment Title
            </th>
            <th>
                Due Date
            </th>
            <th>
                Class
            </th>
            <th>
                Course Code
            </th>
            <th>
                Mark Submission
            </th>
            <th>
                Mark Progress
            </th>
            <th>
                Status
            </th>
            <th>
                Mark
            </th>
        </thead>

        @foreach($allAssignment as $all)
        <tr>
            <td>
                {{ $all->assignment_id }}
            </td>

            <td>
                {{ $all->assignment_title }}
            </td>

            <td>
                {{ $all->assignment_due_date }}
            </td>

            <td>
                {{ $all->class_name }}
            </td>

            <td>
                {{ $all->subject_code }}
            </td>

            <td>
                <?php
                $class = DB::table('student_list')->where('student_class', $all->class_name)->get();
                $totalStudent = count($class);
                $Allsubmission = DB::table('assignment_submission_list')->where('assignment_id', $all->assignment_id)->get();
                $Markedsubmission = DB::table('assignment_submission_list')->where('assignment_id', $all->assignment_id)->where('submission_mark', '!=', NULL)->get();

                $totalAllSubmission = count($Allsubmission);
                $totalMarkedSubmission = count($Markedsubmission);

                if ($totalAllSubmission != 0) {
                    $totalPercentage = ($totalMarkedSubmission / $totalStudent) * 100;
                } else {
                    $totalPercentage = 0;
                }

                ?>
                {{ $totalMarkedSubmission }} / {{ $totalStudent }}
            </td>

            <td>
                <?php
                if ($totalPercentage >= 0 && $totalPercentage <= 30) { ?>
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$totalPercentage}}%;height:15px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$totalPercentage}}%</div>
                <?php } elseif ($totalPercentage >= 31 && $totalPercentage <= 60) { ?>
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{$totalPercentage}}%;height:15px;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">{{$totalPercentage}}%</div>
                <?php } elseif ($totalPercentage >= 61 && $totalPercentage <= 80) { ?>
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{$totalPercentage}}%;height:15px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">{{$totalPercentage}}%</div>
                <?php } elseif ($totalPercentage >= 81 && $totalPercentage <= 100) { ?>
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$totalPercentage}}% ;height:15px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$totalPercentage}}%</div>
                <?php } ?>
            </td>

            <?php
            if ($totalPercentage == 100) { ?>
                <td style="color:green">
                    Completed
                </td>
            <?php } else { ?>
                <td style="color:red">
                    Not Complete
                </td>
            <?php }
            ?>

            <td>
                <a href="{{ route('educatorViewSubmissionPage', ['assignment_id' => $all->assignment_id]) }}">
                    <button class="home_preview_button">Mark Assignment</button></a>
            </td>
        </tr>
        @endforeach
    </table>

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