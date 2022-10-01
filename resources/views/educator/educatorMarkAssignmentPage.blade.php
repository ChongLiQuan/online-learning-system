@include('educator/educatorHeader')
@include('educator/educatorHomeSideBar')

<article id="mainArticle">

    <hr>
    <center>
        @foreach($assignment as $a)
        <table class='student_note_nagivation' border=0 width=100%>
            <tr>
                <td>
                    <!-- Fetch the assignment student name from name list database -->
                    <?php $student_name = DB::table('student_list')->where('student_id', $a->student_id)->pluck('student_name')->first(); ?>
                    <h3>Marking Student Assignment: {{ $a->assignment_id }} ({{ $student_name }})</h3>
                </td>
            </tr>
        </table>
        <br />


        <table class='student_note'>
            <tr>
                <td>
                    {!! $a->submission_content !!}
                </td>
            </tr>
        </table>

        @endforeach

</article>

<div id="siteAds">
    <p class='edu_home_banner'><b>Assignment Marking</b></p>

    <table class="mark_assignment" width="100%" border=0>

        <tr>
            <td>
                <br>
                <form action="{{ route('educatorMarkAssignment')}}" method="post" class="form-group">

                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                    <input type="hidden" name="edit_id" value="{{ $a->submission_id  }}">
                    <input type="hidden" name="assignment_id" value="{{ $a->assignment_id  }}">
                    <input type="number" name="submission_mark" class="assignment_mark_input" min='1' max='{{$a->assignment_full_mark}}' required> / {{$a->assignment_full_mark}} Marks
            </td>
        </tr>
        <tr>
            <td>
                <hr> <br>
                Feedback on Assignment:
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <textarea name="assignment_feedback" class="assignment_feedback" cols="23" rows="15" placeholder="Comments on note .... "></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <button class="approve_button" name="submit" value="1">
                    <span class="button_text" onclick="return confirm('Are you sure?')">Confirm Marking</span></a>
                </button>
                <br><br>
            </td>
        </tr>

    </table>
    </form>
</div>