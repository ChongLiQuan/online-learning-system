@include('admin/adminHeader')

<div class="home-content">

    <center>
        <h1> Edit Existing Subject Information </h1>
        <form action="{{route('editSubject')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            @foreach($subject as $s)
            <input type="hidden" name="subject_id" value="{{ $s->subject_id }}">

            <div class='login_field'>
                <table style='width:40%; text-align:center;'>
                    <tr>
                        <th>
                            <h4>
                                <lable>Subject Code:</label>
                                    <input type="form_name" value="{{ $s->subject_code }}" name="subject_code" class="edu_input" placeholder="Subject Code" autocomplete="off" required disabled>
                            </h4>
                        </th>
                        <th>
                            <h4>
                                <lable>Subject Name:</label>
                                    <input type="form_name" value="{{ $s->subject_name }}" name="subject_name" class="edu_input" placeholder="Subject Name" autocomplete="off" required>
                            </h4>
                        </th>
                    </tr>
                </table>

                <h4>
                    <label>Choose a Form:</label>

                    <select name='form_level'>
                        @foreach($forms as $form)
                        <option name="form_level" value="{{ $form->form_level }}">Form {{ $form->form_level }}</option>
                        @endforeach
                    </select>

                    @if (session('pass_status'))
                    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
                    @endif

                    @if (session('error_status'))
                    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
                    @endif

                    <button class="button login_submit">
                        <span class="button_text">Update Now</span>
                        <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
                    </button>

            </div>
        </form>

        <div class="list_container">

        </div>
        @endforeach