@include('educator/educatorHeader')


<article id="mainArticle">
    <div class="profile-details" style="text-align:right">
        <span class="admin_name">Welcome back, {{ Session::get('username') }}.</span>
    </div>
</article>

<nav id="mainNav">
    <p><b>Navigation Menu</b></p>
    <p><b>Subjects Area:</b></p>

    <p class='course-list'>
        @foreach($subjects as $s)
    <p>&nbsp;&nbsp;&nbsp; <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp;<a href="{{ route('courseHome',['id' => $s->id]) }}">{{ $s->subject_code }} {{ $s->class_name }} </a></p>
    @endforeach
    </p>

    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/educatorAddAnnouncement">Make Announcement</a></p>


</nav>

<div id="siteAds">
    <p><b>Announcement</b></p>

    @foreach($announcement as $a)
    <p>&nbsp;-</i> <a href="/educatorAnnouncement#{{ $a->id }}">{{ $a->annouce_title }}</a> </p>
    @endforeach

</div>