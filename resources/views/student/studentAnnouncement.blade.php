@include('student/studentHeader')

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="js/ckeditor.js"></script>

<div class='fullContent'>
    <center>
        <h3>All Announcement</h3>

        @if (session('delete_status'))
        <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
        @endif

        @foreach($list as $l)
        <br />
        <table class='announcement' border='0'>

            <colgroup>
                <col span="1" style="width: 60%;">
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 10%;">
            </colgroup>

            <tr>
                <td>
                    <h3><u>{{ $l->annouce_title }}</u></h3>
                </td>
                <td>
                    <p> {{ $l->created_at }} </p>
                </td>
                <td>
                    <p> {{ $l->annouce_subject }} </p>
                </td>
                <td>
                    <p> {{ $l->annouce_class }} </p>
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    <hr />

                    <p> {!! $l->annouce_content !!} </p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style='text-align:right'>
                    <form action="{{route('readAnnouncement')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                        <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                        <input type='hidden' name='announcement_id' value="{{ $l->id }}">
                        <?php 
                            $status = DB::table('announcement_status')->where('annouce_id', $l->id)->where('student_name', Session::get('username'))->pluck('status')->first();
                        ?>
                        <button class="button login_submit" <?php if ($status == '1'){ ?> disabled <?php   } ?>>
                            <span class="button_text">Read</span>
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