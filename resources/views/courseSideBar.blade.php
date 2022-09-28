<nav id="mainNav_courseHome">

    @if(Session::get('user_role') == 1)
    <p class='edu_home_banner'><b>[{{Session::get('current_subject_code') }}] {{Session::get('current_course_name')}} ({{ Session::get('current_class_name') }})</b></p>
    @endif

    @if(Session::get('user_role') == 2)
    <p class='stu_home_banner'><b>[{{Session::get('current_subject_code') }}] {{Session::get('current_course_name')}} ({{ Session::get('user_class') }})</b></p>
    @endif

    <?php $course_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('user_class'))->pluck('class_subject_id')->first(); ?>

    @if(Session::get('user_role') == 1)
    <p><a href="{{ Session::get('current_course_url') }}">Course Home Page</a></p>
    @endif
    @if(Session::get('user_role') == 2)
    <p><a href="/courseHome/{{$course_id}}">Course Home Page</a></p>
    @endif
    <p><a href="https://app.videosdk.live/rooms/classroom/Educator_631069fab54dda634645d36d/bpjw-zv9r-dzi8">Online Classroom</a></p>
    <p><a href="/courseStudentNotePage">Student Note</a></p>
    <hr />
    </p>

    @if(Session::get('user_role') == 1)
    <p><a href="/educatorAddFolder">Add New Folder</a></p>
    <p><a href="/educatorAddContent">Add Content</a></p>
    <p><a href="/educatorAddDiscussion">Add Discussion</a></p>
    <p><a href="/educatorAddAssignmentPage">Add Assignment</a></p>
    <hr />
    <p><a href="/educatorAddAnnouncement">Make Announcement</a></p>
    @endif
</nav>