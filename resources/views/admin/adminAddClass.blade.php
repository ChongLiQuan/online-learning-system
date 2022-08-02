@include('admin/adminHeader')

<div class="home-content">

<center> 
<h1> Add New Class </h1>
    <form action="/adminAddClass" method="post" class="form-group"> 
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    
    <div class='login_field'>
        <input type="form_name" name="class_name" class="field_input" placeholder="New Class Name" autocomplete="off" required> 

        <label for="forms">Choose a Form:</label>
        <select name='form'>
        @foreach($forms as $form)
        <option name="form_name" value="{{ $form->form_name }}">{{ $form->form_name }}</option>
        @endforeach
        </select>   
        
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

    <hr/>
    <div class="list_container">

    <center>
    <h1> Existing Class List</h1>

    @if (session('delete_status'))
    <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
    @endif
    
    <table class='tableForm'> 

    <tr>
        <th>Form Name</th>
        <th>Form Level</th>
        <th>Delete</th>
    </tr>


    </table>
    </div>
    

