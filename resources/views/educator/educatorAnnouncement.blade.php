@include('educator/educatorHeader')

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="js/ckeditor.js"></script>

<div class='fullContent'>
    <center>
        <h3>All Announcement</h3>

        @if (session('delete_pass_status'))
        <p style="text-align:center; color:green;"><b>{{ session('delete_pass_status') }}</b></p>
        @endif

        @if (session('delete_error_status'))
        <p style="text-align:center; color:red;"><b>{{ session('delete_error_status') }}</b></p>
        @endif

        @foreach($list as $l)
        <br />
        <table class='announcement' border='0'>

            <colgroup>
                <col span="1" style="width: 60%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 5%;">
                <col span="1" style="width: 5%;">
            </colgroup>

            <tr>
                <td>
                    <h3><u>{{ $l->annouce_title }}</u></h3>
                </td>
                <td>
                    <p>Posted: {{ $l->created_at }} </p>
                </td>
                <td>
                    <p>Updated: {{ $l->updated_at }} </p>
                </td>
                <td style="text-align:center;">
                    <?php $subject = DB::table('class_subject_list')->where('class_subject_id', $l->class_subject_id)->pluck('subject_code')->first(); ?>
                    <p> {{ $subject }} </p>
                </td>
                <td style="text-align:center;">
                    <?php $class = DB::table('class_subject_list')->where('class_subject_id', $l->class_subject_id)->pluck('class_name')->first(); ?>
                    <p> {{ $class }} </p>
                </td>
            </tr>

            <tr>
                <a id='{{ $l->annouce_id }}'></a>
                <td colspan="5">
                    <hr />

                    <p> {!! $l->annouce_content !!} </p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style='text-align:right'>
                    <form action="/educatorEditAnnouncement" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                        <input type='hidden' name='edit_id' value="{{ $l->annouce_id }}">
                        <button class="button edit_button">
                            <span class="button_text" onclick="return confirm('Are you sure?')">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp; </span>
                        </button>
                    </form>
                </td>

                <td colspan="5" style='text-align:center'>
                    <form action="{{route('deleteAnnouncement')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                        <input type='hidden' name='delete_id' value="{{ $l->annouce_id }}">
                        <button class="button delete_button">
                            <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                        </button>
                    </form>
                </td>
            </tr>

        </table>
        <br /> <br />

        <hr />
        @endforeach

        <script type="text/javascript">
            CKEDITOR.replace('announcement_content', {
                filebrowserUploadUrl: "{{route('uploadImage', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        </script>