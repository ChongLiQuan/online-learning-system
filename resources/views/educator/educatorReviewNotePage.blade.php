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

                </td>
                <td>
                    <h3>Reading Note: {{ $n->student_note_name }}</h3>
                </td>
                <td>

                </td>
            </tr>
        </table>

        <br />


        <table class='student_note'>
            <tr>
                <td>
                    <p>{!! $n->student_note_content !!}</p>
                </td>
            </tr>
        </table>

        @endforeach

</article>

<div id="siteAds">
    <p class='edu_home_banner'><b> Add Comments</b></p>
    <hr />

    <form action="{{ route('reviewStudentNote') }}" method="post" class="form-group">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

        <input type="hidden" name="delete_id" value="{{ $n->student_note_id }}">

        <textarea name="comment" rows="8" cols="28" placeholder="Comments on note .... "></textarea>


        <table width="100%">
            <tr>
                <td>
                    <button class="approve_button" name="submit" value="1">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Approve</span></a>
                    </button>
                </td>
                <td style="text-align:right;">
                    <button class="delete_folder_button" name="submit" value="0">
                        <span class="button_text" onclick="return confirm('Are you sure?')">Reject</span></a>
                    </button>
                </td>
            </tr>

        </table>
    </form>

</div>