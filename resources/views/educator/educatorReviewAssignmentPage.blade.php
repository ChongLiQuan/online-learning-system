@include('educator/educatorHeader')
@include('educator/educatorHomeSideBar')

<article id="mainArticle">

    <hr>
    <center>
        @foreach($assignment as $a)
        <table class='student_note_nagivation' border=0 width=100%>
            <tr>
                <td>
                    <h3>Marking Student Assignment: {{ $a->assignment_id }}</h3>
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

    <table class="mark_assignment" width="100%" border=1>

        <tr>
            <td>
                <form action="{{ route('reviewStudentNote') }}" method="post" class="form-group">

                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                    <input type="hidden" name="delete_id" value="{{ $a->assignment_id  }}">
                    <input type="text" name="submission_mark" class="assignment_mark_input"> / {{$a->assignment_full_mark}}
            </td>
        </tr>
        <tr>
            <td>

                <textarea name="comment" class="assignment_feedback" cols="23" rows="10" placeholder="Comments on note .... "></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <button class="approve_button" name="submit" value="1">
                    <span class="button_text" onclick="return confirm('Are you sure?')">Confirm Marking</span></a>
                </button>
            </td>
        </tr>

    </table>
    </form>
</div>