@include('educator/educatorHeader')

<div class='fullContent'>

    <table class='educatorProfile' border="1">

        <div style="position:absolute; left:800px; top:165px; height:fit-content;" class="popup" onclick="myFunction()"><u>Info</u><span class="popuptext" id="myPopup">If there is any incorrect information. Please contact the institution IT department to proceed with request of changing profile details. IT@gmail.com.my.</span></div>

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
    </table>

</div>

<script>
    // When the user clicks on div, open the popup
    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
</script>