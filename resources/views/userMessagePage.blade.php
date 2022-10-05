<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

@if(Session::get('user_role') == 1)
@include('educator/educatorHeader')
@endif

@if(Session::get('user_role') == 2)
@include('student/studentHeader')
@endif

<link rel="stylesheet" href="<?php echo asset('css/chatroom.css') ?>" type="text/css">


<nav id="mainNav_courseHome">
    <table class="note_list">
        <colgroup>
            <col span="1" style="width: 30%;">
            <col span="1" style="width: 10%;">
        </colgroup>

        <thead>
            <th>
                Name
            </th>
            <th>
                Chat Button
            </th>
        </thead>

        @foreach($allUsers as $a)
        <tr>
            <td>
                {{$a->user_full_name}}
            </td>

            <td>
                <center>
                    <a href="{{ route('loadMessage', ['to_student_id' => $a->user_name]) }}">
                        <button class="read_button">Chat</button>
                </center>
            </td>
        </tr>
        @endforeach
    </table>
</nav>

<article id="mainArticle">
    <?php if ((Session::get('to_student_id')) != NULL) {  ?>
        <table class="chat_table" border=1>
            <colgroup>
                <col span="1" style="width: 90%;">
                <col span="1" style="width: 10%;">
            </colgroup>

            <tr style="line-height: 15px; vertical-align: top;">
                <td colspan="2"> Username: {{Session::get('to_student_id')}}</td>
            </tr>

            <!-- Load Messages -->
            <?php
            $messages = DB::table('messages_list')->where('from_user_id', Session::get('username'))->where('to_user_id', Session::get('to_student_id'))->orderBy('message_date', 'ASC')->get();            ?>
            <tr style="line-height: 500px;">
                <td colspan="2" style="line-height: 500px;">
                    <table style="height:600px; width: 100%;" border="1">
                        @foreach($messages as $msg)
                        <tr>
                            <td>{{ $msg->message_content }}
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>

            <!-- Send Message Field -->
            <tr style="line-height: 8px; vertical-align: bottom;">
                <td>
                    <center>
                        <form action="{{route('sendMessage')}}" method="post" class="form-group">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <textarea name="message" class="message_textarea" cols="130" rows="7" placeholder="Send Messages .... "></textarea>
                </td>
                <td>
                    <button class="button delete_button">
                        <span class="button_text">Send Message</span>
                    </button>
                    </form>
                    </center>
                </td>
            </tr>
        </table>
    <?php } ?>
</article>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('.note_list').DataTable({
        searching: true,
        ordering: false,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "ALL"]
        ]
    });
</script>