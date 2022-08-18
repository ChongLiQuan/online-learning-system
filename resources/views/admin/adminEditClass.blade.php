@include('admin/adminHeader')

<div class="home-content">

<center> 
<h1> Update Existing Class Information </h1>
    <form action="{{route('editClass')}}" method="post" class="form-group"> 
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    
    @foreach($class as $c)

    <div class='login_field'>
        <input type="form_name" name="class_name" class="field_input" value="{{ $c->class_name }}" placeholder="New Class Name" autocomplete="off" required> 

        <label>Choose a Form:</label>
        <select name='form_name'>
        @foreach($forms as $form)
        <option name="form_name" value="{{ $form->form_name }}">{{ $form->form_name }}</option>
        @endforeach
        </select>   
        
        <input type = "hidden" name = "class_id" value="{{ $c->class_id }}">

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