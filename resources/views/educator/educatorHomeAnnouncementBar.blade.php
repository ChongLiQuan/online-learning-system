
<div id="siteAds">
    <p class='edu_home_banner'><b>Announcement</b></p>
    <hr />

    @foreach($announcement as $a)
    <p>&nbsp;-</i> <a href="/educatorAnnouncementPage#{{ $a->annouce_id }}">{{ $a->annouce_title }}</a> </p>
    @endforeach

</div>