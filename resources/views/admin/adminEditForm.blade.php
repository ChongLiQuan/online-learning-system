@include('admin/adminHeader')

<div class="home-content">

    <center>
        <h1> Update Existing Form Information</h1>
        <form action="{{route('editForm')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            @foreach($forms as $f)

            <div class='login_field'>
                <input type="form_name" name="form_name" class="field_input" value="{{$f->form_name}}" placeholder="New Form Name" autocomplete="off" required>

                <input type="form_level" name="form_level" class="field_input" value="{{$f->form_level}}" placeholder="Form Level (1-6)" autocomplete="off" required>

                <input type="hidden" name="form_id" value="{{$f->form_id}}">


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

</div>

@endforeach