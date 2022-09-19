@include('student/studentHeader')
@include('student/studentSidebar')

<?php
$active_status = DB::table('student_note_list')->where('student_id', Session::get('username'))->where('student_note_id', Session::get('current_note_id'))->pluck('active_status')->first();
?>

<article id="mainArticle">

    <?php if ($active_status == 1) { ?>
        <p><b><a href=" {{ Session::get('previous_folder_page') }}">Go Back</a></b></p>
    <?php } ?>

    <hr>
    <center>
        @foreach($note as $n)
        <table class='student_note_nagivation' border=0 width=100%>
            <colgroup>
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 30%;">
            </colgroup>

            <tr>
                <td>

                    <?php if ($active_status == 1) { ?>
                        <form action="{{ route('studentEditNoteView', ['student_note_id' =>  $n->student_note_id]) }}" method="get" class="form-group">
                            <p style="text-align: left;"> &nbsp;
                                <button class="add_folder_button">
                                    <span class="button_text">Edit Note</span></a>
                                </button>
                        </form>
                    <?php } ?>
                </td>

                <td>
                    <h3>Reading Note: {{ $n->student_note_name }}</h3>
                    <?php if ($active_status == 0) { ?>
                        <p style='color:#FF8C00;'>*Preview of a deleted folder*</p>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($active_status == 1) { ?>
                        <form action="{{ route('studentDeleteNote') }}" method="post" class="form-group">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                            <input type="hidden" name="delete_id" value="{{ $n->student_note_id }}">
                            <p style="text-align: right;"> &nbsp;
                                <button class="delete_folder_button">
                                    <span class="button_text" onclick="return confirm('Are you sure?')">Delete Note</span></a>
                                </button>
                        </form>
                    <?php } ?>
                </td>
            </tr>
        </table>

        <br />

        <form action="{{route('studentEditNote')}}" method="POST" class="form-group">
        </form>

        <table class='student_note'>
            <tr>
                <td>
                    <p>{!! $n->student_note_content !!}</p>
                </td>
            </tr>
        </table>

        @endforeach

</article>

@include('tinyEditor')
