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
        <?php
        $status = DB::table('announcement_status')->where('annouce_id', $l->annouce_id)->where('student_id', Session::get('username'))->pluck('annouce_status')->first();
        ?>

        <?php if ($status == 0) { ?>
            <table class='announcement' border='0' style="background-color:#FFFFE0">
            <?php  } elseif ($status == 1) { ?>
                <table class='announcement' border='0'>
                <?php } ?>

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
                        <p> {{ $l->created_at }} </p>
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
                    </a>
                </tr>

                <tr>
                    <td colspan="5" style='text-align:right'>
                        <form action="{{route('readAnnouncement')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                            <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                            <input type='hidden' name='announcement_id' value="{{ $l->annouce_id }}">
                            <button class="button login_submit" <?php if ($status == '1') { ?> disabled <?php   } ?>>
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