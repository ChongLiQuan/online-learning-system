@include('student/studentHeader')

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
                            {{$p->student_name}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            IC Number:
                        </td>
                        <td>
                            {{$p->student_IC}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Form (Tingkatan):
                        </td>
                        <td>
                            {{$p->student_form}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Age:
                        </td>
                        <td>
                            {{$p->student_age}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Permanent Address:
                        </td>
                        <td>
                            {{$p->student_address}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Email Address:
                        </td>
                        <td>
                            {{$p->student_email}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Gender:
                        </td>
                        <td>
                            {{$p->student_gender}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Date of Birth:
                        </td>
                        <td>
                            {{$p->student_dob}}
                        </td>
                    </tr>
                    @endforeach

                </table>
            </td>

            <td>
                <h3>Change Account Password</h3>
                <table class="changePassword" border=0>
                    <form action="{{route('studentUpdatePassword')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                        <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                        <tr>
                            <td style='background:rgb(184, 217, 255);'>Current Password:</td>
                            <td><input type="text" name="current_password" class="setting_input" placeholder="Current Password" autocomplete="off" required></td>
                        </tr>
                        <tr>
                            <td style='background:rgb(184, 217, 255);'>New Password:</td>
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
                <h3>Coursework Marks</h3>
                <table class='studentSetting' border=0>
                    <colgroup>
                        <col span="1" style="width: 5%;">
                        <col span="1" style="width: 30%;">
                        <col span="1" style="width: 15%;">
                        <col span="1" style="width: 50%;">
                    </colgroup>

                    <tr>
                        <td>ID</td>
                        <td>Assignment Title</td>
                        <td>Assignment Mark</td>
                        <td>Educator Feedback</td>
                    </tr>

                    @foreach($allAssignment as $a)

                    <tr>
                        <td>
                            {{$a->submission_id}}
                        </td>
                        <td>
                            {{$a->assignment_title}}
                        </td>
                        <td>
                            {{$a->submission_mark}} / {{$a->assignment_full_mark}} Marks
                        </td>
                        <?php if ($a->submission_mark == null) { ?>
                            <td style="color:orange;">
                                Pending
                            </td>
                        <?php } ?>
                        <?php if ($a->submission_mark != null) { ?>
                            <?php if ($a->submission_educator_feedback == null) { ?>
                                <td>
                                    No Feedback
                                </td>
                            <?php } else { ?>
                                <td>
                                    {{$a->submission_educator_feedback}}
                                </td>
                        <?php }
                        } ?>
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