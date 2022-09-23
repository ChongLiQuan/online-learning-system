@if(Session::get('user_role') == 1)
@include('educator/educatorHeader')
@endif

@if(Session::get('user_role') == 2)
@include('student/studentHeader')
@endif
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
                <a href="{{ route('courseContent', ['subject_folder_id' => $f->subject_folder_id]) }}">{{ $f->subject_folder_name }}</u></a>
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