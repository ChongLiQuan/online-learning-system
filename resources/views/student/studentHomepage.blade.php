@include('student/studentHeader')


<article id="mainArticle">
    <div class="profile-details" style="text-align:right">
        <span class="admin_name">Welcome back, {{ Session::get('username') }}.</span>
    </div>
</article>

<nav id="mainNav">
    <p><b>Navigation Menu</b></p>
    <hr />

    <p><b>Subjects Area:</b></p>

    <p class='course-list'>
        @foreach($subjects as $s)
    <p>&nbsp;&nbsp;&nbsp; <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp;<a href="{{ route('courseHome',['id' => $s->class_subject_id]) }}">{{ $s->subject_code }} {{ $s->class_name }} </a></p>
    @endforeach
    </p>

    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentAnnouncement">Check Announcement</a></p>


</nav>

<div id="siteAds">
    <p><b>Announcement</b></p>
    <hr />

    @foreach($announcement as $a)
    <p>&nbsp;-</i> <a href="/studentAnnouncement#{{ $a->annouce_id }}">{{ $a->annouce_title }}</a> </p>
    @endforeach

</div>