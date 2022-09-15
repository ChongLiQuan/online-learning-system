<nav id="mainNav">
    <p class='stu_home_banner'><b>Navigation Menu</b></p>
    <hr />

    <p class='stu_home_banner'><b>Subjects Area:</b></p>

    <p class='course-list'>
        @foreach($subjects as $s)
    <p>&nbsp;&nbsp;&nbsp; <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp;<a href="{{ route('courseHome',['id' => $s->class_subject_id]) }}">{{ $s->subject_code }} {{ $s->class_name }} </a></p>
    @endforeach
    </p>

    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentAnnouncement">Check Announcement</a></p>
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentHomepage">Write Notes</a></p>

    <hr />
    <p class='stu_home_banner'><b>Recycler Bin</b></p>

    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentDeletedFolder">Deleted Folders</a></p>
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentDeletedNote">Deleted Notes</a></p>


</nav>

<div id="siteAds">
    <p class='stu_home_banner'><b>Announcement</b></p>
    <hr />

    @foreach($announcement as $a)
    <p>&nbsp;-</i> <a href="/studentAnnouncement#{{ $a->annouce_id }}">{{ $a->annouce_title }}</a> </p>
    @endforeach

</div>