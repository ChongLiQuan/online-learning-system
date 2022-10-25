@include('admin/adminHeader')

<div class="home-content">

    <center>
        <h1> Add New Form </h1>
        <form action="{{route('addForm')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div class='login_field'>
                <input type="form_name" name="form_name" class="field_input" placeholder="New Form Name" autocomplete="off" required>
                @error('form_name')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror

                <input type="form_level" name="form_level" class="field_input" placeholder="Form Level (1-6)" autocomplete="off" required>
                @error('form_level')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror


                @if (session('pass_status'))
                <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
                @endif

                @if (session('error_status'))
                <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
                @endif


                <button class="button login_submit">
                    <span class="button_text">Add Now</span>
                    <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
                </button>

            </div>
        </form>

</div>

<div class="list_container">
    <!-- For the margin gap -->
</div>

<hr />
<div class="list_container">

    <center>
        <h1> Existing Form List</h1>
        <div class="list_container">

            @if (session('delete_status'))
            <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
            @endif

            <table class='sortable' style='text-align: center;'>
                <tr>
                    <th>Form ID</th>
                    <th>Form Name</th>
                    <th>Form Level</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                @foreach($forms as $form)

                <tr>
                    <td>
                        <h4> {{ $form->form_id }} </h4>
                    </td>

                    <td>
                        <h4> {{ $form->form_name }} </h4>
                    </td>

                    <td>
                        <h4> {{ $form->form_level }} </h4>
                    </td>

                    <td>
                        <form action="{{route('editFormRoute')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                            <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                            <input type='hidden' name='edit_form' value="{{ $form->form_id }}">
                            <button class="button login_submit">
                                <span class="button_text">Edit</span>
                            </button>
                        </form>
                    </td>

                    <td>
                        <form action="{{route('deleteForm')}}" method='POST' class='form-group' action='/' enctype='multipart/form-data'>
                            <input type='hidden' name='_token' value='<?php echo csrf_token(); ?>'>
                            <input type='hidden' name='delete_form' value="{{ $form->form_name }}">
                            <button class="button login_submit">
                                <span class="button_text" onclick="return confirm('Are you sure?')">Delete Form</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>

            <center>
                <div class='pagination'>
                    {{$forms->links()}}
                </div>
            </center>

        </div>