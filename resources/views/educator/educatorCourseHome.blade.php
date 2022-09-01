@include('educator/educatorHeader')
<link rel="icon" href="{!! asset('educator/images/login_logo.jpeg') !!}" />
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<nav id="mainNav_courseHome">
    <br />

    @foreach($subjects as $s)
    <?php $course_name = DB::table('subject_list')->where('subject_code', $s->subject_code)->pluck('subject_name')->first();
    Session::put('current_subject_code', $s->subject_code);
    Session::put('current_class_name', $class_name);
    Session::put('current_course_url', URL::current());
    Session::put('current_course_name', $course_name);
    ?>

    <p><b>[{{$s->subject_code }}] {{Session::get('current_course_name')}} ({{ $class_name }})</b></p>
    @endforeach

    <p><a href="">Course Home Page</a></p>
    <p><a href="https://app.videosdk.live/rooms/classroom/Educator_631069fab54dda634645d36d/bpjw-zv9r-dzi8">Online Classroom</a></p>
    </p>
    <p><a href="/educatorAddFolder">Add New Folder</a></p>
    <p><a href="/educatorAddContent">Add Content</a></p>
    <p><a href="/educatorAddAnnouncement">Make Announcement</a></p>
</nav>

<article id="mainArticle"><b>Class Hall</b>

    @if (session('delete_status'))
    <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
    @endif

    <hr>
    @foreach($folders as $f)
    <table class='folder' border=0>
        <tr>
            <th width='5%'>
                <img src="{{URL::asset('/images/folder_logo.png')}}" height='50px' width='50px' />
            </th>

            <th>
            <a href="{{ route('courseContent', ['folder_id' => $f->folder_id]) }}">{{ $f->folder_name }}</u></a>
            </th>
        </tr>

        <tr>
            <td colspan="2">
                <hr>
                <p>{!! $f->folder_content !!} Ok </p>
            </td>
        </tr>

        <tr>
            <td colspan="4" style='text-align:right'>
                <form action="{{route('deleteFolder')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                    <input type='hidden' name='delete_id' value="{{ $f->folder_id }}">
                    <button class="button delete_button">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                    </button>
                </form>
            </td>
        </tr>
    </table>
    <hr>
    @endforeach

</article>


<script>
    var msg = '{{Session::get('
    alert ')}}';
    var exist = '{{Session::has('
    alert ')}}';
    if (exist) {
        alert(msg);
    }
</script>