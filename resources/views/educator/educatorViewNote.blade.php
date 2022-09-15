@include('educator/educatorHeader')
@include('educator/educatorHomeSideBar')

<article id="mainArticle">

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

                    <form action="{{ route('approveStudentNote') }}" method="post" class="form-group">
                        <p style="text-align: left;"> &nbsp;
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                            <input type="hidden" name="delete_id" value="{{ $n->student_note_id }}">

                            <button class="approve_button">
                                <span class="button_text">Approve Note</span></a>
                            </button>
                    </form>
                </td>

                <td>
                    <h3>Reading Note: {{ $n->student_note_name }}</h3>
                </td>
                <td>
                    <form action="{{ route('rejectStudentNote') }}" method="post" class="form-group">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                        <input type="hidden" name="delete_id" value="{{ $n->student_note_id }}">
                        <p style="text-align: right;"> &nbsp;
                            <button class="delete_folder_button">
                                <span class="button_text" onclick="return confirm('Are you sure?')">Reject Note</span></a>
                            </button>
                    </form>
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

@include('educator/educatorHomeAnnouncementBar')
@include('ckEditor')