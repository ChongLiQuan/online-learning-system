@include('educator/educatorHeader')
<link rel="stylesheet" href="<?php echo asset('css/discussionPage.css') ?>" type="text/css">

<div class='fullContent'>
    <b>
        <div style="position:absolute; left:400px; top:110px;"> <a href="{{ URL::previous() }}">Go Back</a>
    </b>
</div>
<center>
    <h3>Discussion Page</h3>

    @foreach($discussion as $d)
    <br />
    <table class='announcement' border='0'>

        <colgroup>
            <col span="1" style="width: 50%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 15%;">
            <col span="1" style="width: 15%;">
        </colgroup>

        <tr>
            <td>
                <h3><u>{{ $d->discussion_title }}</u></h3>
            </td>
            <td>
                <p>Published By: {{ $d->discussion_educator }}</p>
            </td>
            <td>
                <p>Created: {{ $d->created_at }} </p>
            </td>
            <td>
                <p>Updated: {{ $d->updated_at }} </p>
            </td>
        </tr>

        <tr>
            <td colspan="5">
                <hr />
                <p> {!! $d->discussion_content !!} </p>
            </td>
        </tr>

        <tr>
            <td colspan="5">
                <a href='/addComment?discussion_id={{$d->discussion_id}}'>
                    <button class="comment_button" style="float: right;">Add Comment</button>
                </a>
            </td>
        </tr>
        </form>
    </table>
    @endforeach

    @foreach($comment as $c)
    <br />
    <table class='comment' border='0'>
        <colgroup>
            <col span="1" style="width: 50%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 15%;">
            <col span="1" style="width: 15%;">
        </colgroup>

        <tr>
            <td colspan="2">
                <h3><u>{{ $c->comment_title }}</u></h3>
            </td>
            <td>
                <p>Commented By: {{ $c->comment_username }}</p>
            </td>
            <td>
                <p>Created: {{ $c->created_at }} </p>
            </td>
            <td>
                <p>Updated: {{ $c->updated_at }} </p>
            </td>
        </tr>

        <tr>
            <td colspan="5">
                <hr />
                <p> {!! $c->comment_content !!} </p>
            </td>
        </tr>

        <tr>
            <td colspan="5">
                <a href='/addComment?discussion_id={{$d->discussion_id}}?sub_comment={{$c->comment_id}}'>
                    <button class="delete_button" style="float: right;">Delete Comment</button>
                </a>
                <a href='/addComment?discussion_id={{$d->discussion_id}}?sub_comment={{$c->comment_id}}'>
                    <button class="comment_button" style="float: right;">Add Comment</button>
                </a>
            </td>
        </tr>
        </form>
        @endforeach


    </table>

    </div>




    @include('ckEditor')