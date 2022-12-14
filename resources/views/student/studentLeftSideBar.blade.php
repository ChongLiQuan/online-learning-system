<nav id="mainNav">
    <p class='stu_home_banner'><b>Navigation Menu</b></p>
    <hr />

    <p class='stu_home_banner'><b>Subjects Area:</b></p>

    <p class='course-list'>
        @foreach($subjects as $s)
    <p>&nbsp;&nbsp;&nbsp; <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp;<a href="{{ route('courseHome',['id' => $s->class_subject_id]) }}">{{ $s->subject_code }} {{ $s->class_name }} </a></p>
    @endforeach
    </p>

    <p class='stu_home_banner'><b>Content Tools:</b></p>
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentAnnouncementPage">Check Announcement</a></p>
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentResultPage">Check Assignment Results</a></p>
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentHomepage">Write Notes</a></p>

    <p class='stu_home_banner'><b>Chat Tool:</b></p>
    <?php
    $messages = DB::table('messages_list')
        ->where('to_user_id', Session::get('username'))
        ->where('message_is_new_status', 1)
        ->get();
    $msgAmount = count($messages);
    ?>
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/userMessagePage" class='notification' style="background-color:aliceblue;">
            <?php if ($msgAmount > 0) { ?>
                <span class="badge">{{ $msgAmount }}</span>
            <?php } ?>
            Chat Room</a></p>

    <p class='stu_home_banner'><b>Recycler Bin:</b></p>

    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentDeletedFolder">Deleted Folders</a></p>
    <p> <i class='bx bxs-right-arrow'></i> &nbsp;&nbsp; <a href="/studentDeletedNote">Deleted Notes</a></p>


</nav>