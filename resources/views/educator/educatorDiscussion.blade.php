@include('educator/educatorHeader')
<link rel="stylesheet" href="<?php echo asset('css/discussionPage.css') ?>" type="text/css">
<?php Session::put('current_course_url', URL::current()); ?>

<nav id="article">
    <b>
        <div style="position:absolute; left:400px; top:110px;"> <a href="{{ Session::get('previous_url') }}">Go Back</a></div>
    </b>

    <center>
        <h3>Discussion Page {{ Session::get('check_sub_comment') }} </h3>

        @foreach($discussion as $d)
        <table class='discussion' border='1'>

            <colgroup>
                <col span="1" style="width: 40%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 10%;">
            </colgroup>

            <tr>
                <td>
                    <h3><u>{{ $d->discussion_title }}</u></h3>
                    <?php Session::put('current_discussion', $d->discussion_id); ?>
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
                <td>
                </td>
            </tr>

            <tr>
                <td colspan="5">
                    <p> {!! $d->discussion_content !!} </p>
                </td>
            </tr>

            <tr>
                <td colspan="5">
                    <a href='/addComment'>
                        <button class="comment_button" style="float: right;">Add Comment</button>
                    </a>
                </td>
            </tr>
            </form>
        </table>
        @endforeach

        <hr style="height:1px;border:1;color:#333;background-color:#333;" />

        @foreach($filtered_comment as $c)
        <br />

        <table class='comment' border='0'>
            <colgroup>
                <col span="1" style="width: 40%;">
                <col span="1" style="width: 20%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 10%;">
            </colgroup>

            <tr>
                <td colspan="1">
                    <h3><u> {{ $c->comment_title }}</u></h3>
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
                <td colspan="4" style='text-align:right'>
                    <form action="/editComment" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                        <input type='hidden' name='edit_id' value="{{ $c->comment_id }}">
                        <button class="button edit_button">
                            <span class="button_text" onclick="return confirm('Are you sure?')">Edit</span>
                        </button>
                    </form>
                </td>
            </tr>

            <tr>
                <td colspan="5">
                    <hr />
                    <p> {!! $c->comment_content !!} </p>
                </td>

            </tr>

            <tr>

                <td colspan="4" style='text-align:right'>
                    <form action="/addComment" method='get' class='form-group' action='/' enctype='multipart/form-data'>
                        <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                        <input type='hidden' name='sub_comment' value="{{ $c->comment_id }}">
                        <button class="button comment_button">
                            <span class="button_text">Add Comment</span>
                        </button>
                    </form>
                </td>

                <td colspan="5" style='text-align:right'>
                    <form action="{{ route('deleteComment') }}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                        <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                        <input type='hidden' name='delete_id' value="{{ $c->comment_id }}">
                        <button class="button delete_button">
                            <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                        </button>
                    </form>
                </td>

            </tr>
            </form>
        </table>
        @endforeach

        <?php if (Session::get('check_sub_comment') == NULL) { ?>

            @foreach($sub_comment as $c)
            <br />

            <table class='comment' border='0'>
                <colgroup>
                    <col span="1" style="width: 40%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 10%;">
                </colgroup>

                <tr>
                    <td colspan="1">
                        <h3><u> {{ $c->comment_title }}</u></h3>
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
                    <td colspan="5" style='text-align:right'>
                        <form action="{{ route('deleteComment') }}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                            <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                            <input type='hidden' name='delete_id' value="{{ $c->comment_id }}">
                            <button class="button delete_button">
                                <span class="button_text" onclick="return confirm('Are you sure?')">Delete</span>
                            </button>
                        </form>
                    </td>

                </tr>
                </form>
            </table>
            @endforeach

        <?php } ?>
</nav>

<div id="mainNav">
    <p><b>All Discussion Comments</b></p>
    <hr />
    @foreach($comment as $c)
    <p><a href="{{ route('discussionBoard', ['discussion_id' => $d->discussion_id, 'comment_id' => $c->comment_id ]) }}"> {{ $c->comment_title }}</a></p>
    @endforeach
</div>

@include('ckEditor')