@if(Session::get('user_role') == 1)
@include('educator/educatorHeader')
@endif

@if(Session::get('user_role') == 2)
@include('student/studentHeader')
@endif

<div class='fullContent'>
    <center>
        <table>
            <tr>
                <td>
                    <img src="{{URL::asset('/images/notification.png')}}" height='50px' width='50px' />
                </td>
                <td>
                    <h3>Notifications</h3>
                </td>
            </tr>
        </table>

        @if (session('delete_status'))
        <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
        @endif

        @foreach($list as $l)
        <?php
        $status = DB::table('notification_list')->where('notification_id', $l->notification_id)->where('user_id', Session::get('username'))->pluck('read_notification_status')->first();
        ?>

        <br />
        <?php if ($status == 0) { ?>
            <table class='notificationTable' border='0' style="background-color:#FFFFE0">
            <?php  } elseif ($status == 1) { ?>
                <table class='notificationTable' border='0'>
                <?php } ?>

                <colgroup>
                    <col span="1" style="width: 85%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 5%;">
                </colgroup>

                <tr>
                    <td>
                        <h3><u>{{ $l->notification_title }}</u></h3>
                    </td>
                    <td>
                        <p>Created: {{ $l->created_at }} </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="5">
                        <hr />

                        <p> {!! $l->notification_content !!} </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="5" style='text-align:right;'>

                        <form action="{{route('readNotification')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                            <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                            <input type='hidden' name='id' value="{{ $l->notification_id }}">

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