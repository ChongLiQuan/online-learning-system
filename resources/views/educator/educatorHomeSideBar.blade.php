<nav id="mainNav">
    <p class='edu_home_banner'><b>Navigation Menu</b></p>
    <hr />

    <p class='edu_home_banner'><b>Subjects Area:</b></p>

    <p class='course-list'>
    @foreach($subjects as $s)
    <p>&nbsp;&nbsp;&nbsp; <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp;<a href="{{ route('courseHome',['id' => $s->class_subject_id]) }}">{{ $s->subject_code }} {{ $s->class_name }} </a></p>
    @endforeach
    </p>
    <hr />
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/educatorAddAnnouncement">Make Announcement</a></p>
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/educatorHomepage">Student Notes Management</a></p>


</nav>