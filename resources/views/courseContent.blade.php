@if(Session::get('user_role') == 1)
@include('educator/educatorHeader')
@endif

@if(Session::get('user_role') == 2)
@include('student/studentHeader')
@endif
<?php Session::put('previous_url', URL::current()); ?>
<link rel="icon" href="{!! asset('educator/images/login_logo.jpeg') !!}" />
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<nav id="mainNav_courseHome">
    <br />

    @foreach($subjects as $s)
    <?php $course_name = DB::table('subject_list')->where('subject_code', Session::get('current_subject_code'))->pluck('subject_name')->first();
    ?>

    @endforeach
    <p><b>[{{ Session::get('current_subject_code')}}] {{Session::get('current_course_name')}} ({{ Session::get('current_class_name') }})</b></p>


    <p><a href="{{ Session::get('current_course_url') }}">Course Home Page</a></p>
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
                <a href="{{ route('courseContent', ['subject_folder_id' => $f->subject_folder_id]) }}">{{$f->subject_folder_name}}</u>
            </th>

            @if(Session::get('user_role') == 1)
            <td colspan="2" style='text-align:right'>
                <form action="/educatorEditFolder" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='edit_id' value="{{ $f->subject_folder_id }}">
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
                <p>{!! $f->subject_folder_content !!}</p>
            </td>
        </tr>
        @if(Session::get('user_role') == 1)
        <tr>
            <td colspan="4" style='text-align:right'>
                <form action="{{route('deleteFolder')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                    <input type='hidden' name='delete_id' value="{{ $f->subject_folder_id }}">
                    <button class="button delete_button">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                    </button>
                </form>
            </td>
        </tr>
        @endif
    </table>
    @endforeach

    @foreach($content_list as $c)
    <table class='folder' border=0>
        <tr>
            <th width='5%'>
                <img src="{{URL::asset('/images/paper_logo.png')}}" height='50px' width='50px' />
            </th>
            <th>
                {{$c->folder_content_title}}
            </th>

            @if(Session::get('user_role') == 1)
            <td colspan="2" style='text-align:right'>
                <form action="/educatorEditContent" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='edit_id' value="{{ $c->folder_content_id }}">
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
                <p>{!! $c->subject_folder_content !!}</p>
            </td>
        </tr>
        @if(Session::get('user_role') == 1)
        <tr>
            <td colspan="4" style='text-align:right'>
                <form action="{{route('deleteContent')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                    <input type='hidden' name='delete_id' value="{{ $c->folder_content_id }}">
                    <button class="button delete_button">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                    </button>
                </form>
            </td>
        </tr>
        @endif
    </table>
    @endforeach

    <hr>

    @foreach($discussion as $d)
    <table class='folder' border=0>
        <tr>
            <th width='5%'>
                <img src="{{URL::asset('/images/discussion_logo.png')}}" height='50px' width='50px' />
            </th>
            <th>
                <a href="{{ route('discussionBoard', ['discussion_id' => $d->discussion_id, 'comment_id' => 0]) }}">{{$d->discussion_title}}</a>
            </th>

            @if(Session::get('user_role') == 1)
            <td colspan="2" style='text-align:right'>
                <form action="/educatorEditDiscussion" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='edit_id' value="{{ $d->discussion_id }}">
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
                <p>{!! $d->discussion_content !!}</p>
            </td>
        </tr>
        @if(Session::get('user_role') == 1)
        <tr>
            <td colspan="4" style='text-align:right'>
                <form action="{{route('deleteDiscussion')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                    <input type='hidden' name='delete_id' value="{{ $d->discussion_id }}">
                    <button class="button delete_button">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                    </button>
                </form>
            </td>
        </tr>
        @endif
    </table>
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