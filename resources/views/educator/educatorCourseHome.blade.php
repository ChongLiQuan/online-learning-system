@include('educator/educatorHeader')
<link rel="icon" href="{!! asset('educator/images/login_logo.jpeg') !!}" />

<article id="mainArticle"><b>Article</b>

</article>

<nav id="mainNav">
    @foreach($subjects as $s)
    <p><b> {{$s->subject_name }} ({{ $subject_code }}) </b></p>
    <p><a href="">Course Home Page</a></p>
    <p><a href="/studyMaterial">Study Material</a></p>
    </p>

    <p><a href="/educatorAddAnnouncement">Make Announcement</a></p>

    @endforeach
</nav>

<div id="siteAds">
    <p><b>Announcement</b></p>

</div>

<footer id="pageFooter">
    @include('educator/educatorFooter')
</footer>

<script>
    var msg = '{{Session::get('
    alert ')}}';
    var exist = '{{Session::has('
    alert ')}}';
    if (exist) {
        alert(msg);
    }
</script>