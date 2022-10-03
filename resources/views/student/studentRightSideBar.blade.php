<?php
$allAssignment = DB::table('assignment_list')
    ->join('subject_folder_list', 'subject_folder_list.subject_folder_id', '=', 'assignment_list.subject_folder_id')
    ->join('class_subject_list', 'class_subject_list.class_subject_id', '=', 'subject_folder_list.class_subject_id')
    ->where('class_subject_list.class_name', Session::get('user_class'))
    ->get();
?>

<div id="siteAds">
    <div class='student_folder_scrollable'>

        <p class='stu_home_banner'><b>Announcement</b></p>
        <hr />

        <table class='student_assignment' border=0>
            @foreach($announcement as $a)
            <tr>
                <p><a href="/studentAnnouncementPage#{{ $a->annouce_id }}">{{ $a->annouce_title }}</a> </p>
            </tr>
            @endforeach
        </table>
    </div>

    <div class='student_folder_scrollable'>
        <p class='stu_home_banner'><b>Assignment Due:</b></p>
        <hr />
        <table class='student_assignment' border=0>
            @foreach($allAssignment as $all)
            <tr>
                <?php $submissions = DB::table('assignment_submission_list')->where('student_id', Session::get('username'))->where('assignment_id', $all->assignment_id)->pluck('student_id')->first(); ?>
                <?php if (is_null($submissions)) { ?>
                    <?php
                    $now = time(); // or your date as well
                    //$your_date = strtotime("2010-01-31");
                    $datediff = strtotime($all->assignment_due_date) - $now;
                    $dueDate = round($datediff / (60 * 60 * 24));
                    ?>
                    <p><b><a href="{{ route('studentSubmitAssignmentPage', ['assignment_id' => $all->assignment_id]) }}">{{ $all->assignment_title }}</b> {{ $dueDate }} Day(s) Left</a></p>
                <?php } ?>
            </tr>
            @endforeach
        </table>
    </div>
</div>
