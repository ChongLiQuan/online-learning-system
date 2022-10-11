@if(Session::get('user_role') == 1)
@include('educator/educatorHeader')
@endif

@if(Session::get('user_role') == 2)
@include('student/studentHeader')
@endif
<?php Session::put('previous_url', URL::current()); ?>
<link rel="icon" href="{!! asset('educator/images/login_logo.jpeg') !!}" />
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

@include('courseSideBar')

<article id="mainArticle">

    @if(Session::get('user_role') == 1)
    <p class='edu_home_banner'><b>Class Hall</b></p>
    @endif

    @if(Session::get('user_role') == 2)
    <p class='stu_home_banner'><b>Class Hall</b></p>
    @endif

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

    <!-- Original Assignment  -->
    @if(Session::get('user_role') == 2)
    @foreach($stu_assignments as $a)
    <table class='folder' border=0>
        <tr>
            <th width='5%'>
                <img src="{{URL::asset('/images/assignment_logo.png')}}" height='50px' width='50px' />
            </th>
            <th>
                @if(Session::get('user_role') == 1)
                <a href="{{ route('educatorViewSubmissionPage', ['assignment_id' => $a->assignment_id]) }}">{{$a->assignment_title}}</a> <b>
                    <p style="color:red">Due On: {{ $a->assignment_due_date }}
                </b></p> </a>
                @endif

                @if(Session::get('user_role') == 2)
                <?php
                $submit_status = DB::table('assignment_submission_list')->where('student_id', Session::get('username'))->where('assignment_id', $a->assignment_id)->get();
                if (count($submit_status) == 0) { ?>
                    <a href="{{ route('studentSubmitAssignmentPage', ['assignment_id' => $a->assignment_id]) }}">{{$a->assignment_title}}</a> <b>
                        <p style="color:red">Due On: {{ $a->assignment_due_date }}
                    </b></p> </a>
                <?php } elseif (count($submit_status) > 0) { ?>
                    <!-- Meaning student submitted -->
                    <a href="{{ route('studentViewOwnSubmissionPage', ['assignment_id' => $a->assignment_id]) }}">{{$a->assignment_title}}</a> <b>
                        <p style="color:red">Due On: {{ $a->assignment_due_date }}
                    </b></p> </a>
                <?php } ?>
                @endif
            </th>

            @if(Session::get('user_role') == 1)
            <td colspan="2" style='text-align:right'>
                <form action="/educatorEditAssignmentPage" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='edit_id' value="{{ $a->assignment_id }}">
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
                <p>{!! $a->assignment_content !!}</p>
            </td>
        </tr>
        @if(Session::get('user_role') == 1)
        <tr>
            <td colspan="4" style='text-align:right'>
                <form action="{{route('deleteAssignment')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                    <input type='hidden' name='delete_id' value="{{ $a->assignment_id }}">
                    <button class="button delete_button">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                    </button>
                </form>
            </td>
        </tr>
        @endif
    </table>
    @endforeach
    @endif
    <!--  -->

    <!-- New Edu Assignment  -->
    @if(Session::get('user_role') == 1)
    @foreach($edu_assignments as $a)
    <table class='folder' border=0>
        <tr>
            <th width='5%'>
                <img src="{{URL::asset('/images/assignment_logo.png')}}" height='50px' width='50px' />
            </th>
            <th>
                @if(Session::get('user_role') == 1)
                <?php $current_date_time = \Carbon\Carbon::now()->toDateTimeString(); ?>

                <?php if ($a->assignment_due_date <= $current_date_time) { ?>
                    <a href="{{ route('educatorViewSubmissionPage', ['assignment_id' => $a->assignment_id]) }}">{{$a->assignment_title}} [PAST DUE]</a> <b>
                        <p style="color:red">Due On: {{ $a->assignment_due_date }}
                    </b></p> </a>
                <?php } else { ?>
                    <a href="{{ route('educatorViewSubmissionPage', ['assignment_id' => $a->assignment_id]) }}">{{$a->assignment_title}}</a> <b>
                        <p style="color:red">Due On: {{ $a->assignment_due_date }}
                    </b></p> </a>
                <?php } ?>
                @endif
            </th>

            @if(Session::get('user_role') == 1)
            <td colspan="2" style='text-align:right'>
                <form action="/educatorEditAssignmentPage" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='edit_id' value="{{ $a->assignment_id }}">
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
                <p>{!! $a->assignment_content !!}</p>
            </td>
        </tr>
        @if(Session::get('user_role') == 1)
        <tr>
            <td colspan="4" style='text-align:right'>
                <form action="{{route('deleteAssignment')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                    <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                    <input type='hidden' name='delete_id' value="{{ $a->assignment_id }}">
                    <button class="button delete_button">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                    </button>
                </form>
            </td>
        </tr>
        @endif
    </table>
    @endforeach
    @endif

    <!--  -->
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