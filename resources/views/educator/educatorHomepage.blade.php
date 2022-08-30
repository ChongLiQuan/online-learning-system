@include('educator/educatorHeader')


<article id="mainArticle">Article

</article>

<nav id="mainNav">
    <p><b>Navigation Menu</b></p>
    <p><b>Subjects Area:</b></p>

    <p class='course-list'>
        @foreach($subjects as $s)
        <!-- <p>&nbsp;&nbsp;&nbsp;<a href="/educatorCourseHome/{{ $s->subject_code }}">{{ $s->subject_code }} {{ $s->class_name }} </a></p> -->
    <p>&nbsp;&nbsp;&nbsp; <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp;<a href="{{ route('courseHome',['subject_code' => $s->subject_code]) }}">{{ $s->subject_code }} {{ $s->class_name }} </a></p>

    @endforeach
    </p>

    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/educatorAddAnnouncement">Make Announcement</a></p>


</nav>

<div id="siteAds">
    <p><b>Announcement</b></p>

    @foreach($announcement as $a)
    <p>&nbsp;-</i> <a href="/educatorEditAnnouncement">{{ $a->annouce_title }}</a> </p>
    @endforeach

</div>

<footer id="pageFooter">
    @include('educator/educatorFooter')
</footer>s