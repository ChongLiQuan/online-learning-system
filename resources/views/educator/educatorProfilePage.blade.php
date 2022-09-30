@include('educator/educatorHeader')

<div class='fullContent'>

    <table class='educatorProfile' border="0">

        <div style="position:absolute; left:700px; top:165px; height:fit-content;" class="popup" onclick="myFunction()"><u>Info</u><span class="popuptext" id="myPopup">If there is any incorrect information. Please contact the institution IT department to proceed with request of changing profile details. IT@gmail.com.my.</span></div>

        <colgroup>
            <col span="1" style="width: 50%;">
            <col span="1" style="width: 50%;">
        </colgroup>

        <tr>
            <td>
                <h3>Your Profile Information</h3>

                <table class='profileInformation' border=0>
                    @foreach($profile as $p)
                    <colgroup>
                        <col span="1" style="width: 35%;">
                        <col span="1" style="width: 65%;">
                    </colgroup>

                    <tr>
                        <td>
                            Full Name:
                        </td>
                        <td>
                            {{$p->edu_name}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            IC Number:
                        </td>
                        <td>
                            {{$p->edu_IC}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Teaching Experience (Years):
                        </td>
                        <td>
                            {{$p->edu_year}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Age:
                        </td>
                        <td>
                            {{$p->edu_age}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Permanent Address:
                        </td>
                        <td>
                            {{$p->edu_address}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Email Address:
                        </td>
                        <td>
                            {{$p->edu_email}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Gender:
                        </td>
                        <td>
                            {{$p->edu_gender}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Date of Birth:
                        </td>
                        <td>
                            {{$p->edu_dob}}
                        </td>
                    </tr>
                    @endforeach

                </table>
            </td>

            <td>
                <h3>Change Account Password</h3>
                <table class="changePassword" border=0>
                    <form action="{{route('updatePassword')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                        <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                        <tr>
                            <td style='background:#ffc876;'>Current Password:</td>
                            <td><input type="text" name="current_password" class="setting_input" placeholder="Current Password" autocomplete="off" required></td>
                        </tr>
                        <tr>
                            <td style='background:#ffc876;'>New Password:</td>
                            <td><input type="text" name="new_password" class="setting_input" placeholder="New Password" autocomplete="off" required></td>
                        </tr>
                        <tr>
                            <td colspan='2' style="background-color:none;">
                                <center>
                                    @if (session('pass_status'))
                                    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
                                    @endif

                                    @if (session('error_status'))
                                    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
                                    @endif

                                    <button class="setting_button">Change Password</button>
                                </center>
                            </td>

                        </tr>
                    </form>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <h3>Assignment Email Notification Alert</h3>
                <table class='assignmentSetting' border=0>
                    <colgroup>
                        <col span="1" style="width: 10%;">
                        <col span="1" style="width: 60%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 15%;">
                    </colgroup>

                    @foreach($allAssignment as $a)

                    <tr>
                        <td>
                            {{$a->assignment_id}}
                        </td>
                        <td>
                            {{$a->assignment_title}}
                        </td>
                        <td>
                            {{$a->class_name}}
                        </td>
                        <td>
                            <?php if ($a->assignment_email_educator_status == 1) { ?>
                                <form action="{{route('updateEmailStatus')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

                                    <input type='hidden' name='edit_id' value="{{ $a->assignment_id }}">
                                    <input type='hidden' name='button_value' value="0">
                                    <button class="button switch_button_on">
                                        <span class="button_text" onclick="return confirm('Are you sure you want to turn off?')">On</span>
                                    </button>
                                </form>
                            <?php } ?>

                            <?php if ($a->assignment_email_educator_status == 0) { ?>
                                <form action="{{route('updateEmailStatus')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf
                                    <input type='hidden' name='edit_id' value="{{ $a->assignment_id }}">
                                    <input type='hidden' name='button_value' value="1">
                                    <button class="button switch_button_off">
                                        <span class="button_text" onclick="return confirm('Are you sure you want to turn on?')">Off</span>
                                    </button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="background:white;">
                            {{$allAssignment->links()}}
                        </td>
                    </tr>
                </table>
            </td>
    </table>

</div>

<script>
    // When the user clicks on div, open the popup
    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
</script>