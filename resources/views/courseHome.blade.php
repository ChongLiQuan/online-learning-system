@if(Session::get('user_role') == 1)
@include('educator/educatorHeader')
@endif

@if(Session::get('user_role') == 2)
@include('student/studentHeader')
@endif
<link rel="icon" href="{!! asset('educator/images/login_logo.jpeg') !!}" />
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<nav id="mainNav_courseHome">
    <br />

    @foreach($subjects as $s)
    <?php $course_name = DB::table('subject_list')->where('subject_code', $s->subject_code)->pluck('subject_name')->first();
    Session::put('current_subject_code', $s->subject_code);
    Session::put('current_class_name', $class_name);
    Session::put('current_course_url', URL::current());
    Session::put('previous_url', URL::current());
    Session::put('current_course_name', $course_name);
    ?>

    <p><b>[{{$s->subject_code }}] {{Session::get('current_course_name')}} ({{ $class_name }})</b></p>
    @endforeach

    <p><a href="{{ Session::get('previous_url') }}">Course Home Page</a></p>
    <p><a href="https://app.videosdk.live/rooms/classroom/Educator_631069fab54dda634645d36d/bpjw-zv9r-dzi8">Online Classroom</a></p>
    <hr />
    </p>

    @if(Session::get('user_role') == 1)
    <p><a href="/educatorAddFolder">Add New Folder</a></p>
    <p><a href="/educatorAddContent">Add Content</a></p>
    <p><a href="/educatorAddDiscussion">Add Discussion</a></p>
    <hr />
    <p><a href="/educatorAddAnnouncement">Make Announcement</a></p>
    @endif
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

            @if(Session::get('user_role') == 1)
            <td colspan="2" style='text-align:right'>
                <form action="/educatorEditFolder" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='edit_id' value="{{ $f->folder_id }}">
                    <button class="button edit_button">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Edit</span>
                    </button>
                </form>
            </td>
            @endif
        </tr>

        <tr>
            <td colspan="3">
                <hr>
                <p>{!! $f->folder_content !!}</p>
            </td>
        </tr>

        @if(Session::get('user_role') == 1)
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
        @endif
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