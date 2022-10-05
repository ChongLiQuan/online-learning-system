<?php $student_info = DB::table('student_list')->where('student_id', $student_id)->get();  ?>
<?php $assignment_info = DB::table('assignment_list')->where('assignment_id', $assignment_id)->get(); ?>
<?php use Carbon\Carbon; $currentTime = Carbon::now(); ?>

Dear Educator,

<br><br>

@foreach($student_info as $s)
@foreach($assignment_info as $a)

A assignment submission has recieved from {{$s->student_name}}!

<br><br>

<?php
$subject_code =
    DB::table('class_subject_list')
    ->join('subject_folder_list', 'subject_folder_list.class_subject_id', '=', 'class_subject_list.class_subject_id')
    ->where('subject_folder_list.subject_folder_id', $a->subject_folder_id)
    ->pluck('class_subject_list.subject_code')
    ->first();

    $subject_name = DB::table('subject_list')->where('subject_code', $subject_code)->pluck('subject_name')->first();
?>

Student Details: <br>
Student Name: {{$s->student_name}} <br>
Student Class: {{$s->student_class}} <br><br><br>

Submission Details:<br>
Title of the Subject: {{$subject_name}}<br>
Subject Code: {{$subject_code}}<br>
Title of the assignment: {{$a->assignment_title}}<br>
Submission Date: {{$currentTime}}<br>


@endforeach
@endforeach
<br><br>
This is an automated message, plese do not reply.