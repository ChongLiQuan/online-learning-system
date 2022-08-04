@include('admin/adminHeader')

<div class="home-content">

<center> 
<h1> Add New Class </h1>
    <form action="{{route('addClass')}}" method="post" class="form-group"> 
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    
    <div class='login_field'>
        <input type="form_name" name="class_name" class="field_input" placeholder="New Class Name" autocomplete="off" required> 

        <label>Choose a Form:</label>
        <select name='form_name'>
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
<h1>Existing Class List </h1>

<table style=' width:29%;'>
    <tr>
        <th style= 'text-align: left;'>
    <form action="{{route('filterClass')}}" method="post" class="form-group"> 
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <select name='filter_form'>
        @foreach($forms as $form)
        <option name="form_name" value="{{ $form->form_name }}">{{ $form->form_name }}</option>
        @endforeach
        </select>   
        
        <button class="button login_submit">
		<span class="button_text">Search</span>
		</button>
    </form>
    </th>
    <th style= 'text-align: right;'>

    <form action="adminAddClass">
        <button class="button login_submit">
		<span class="button_text">Display All</span>
    </form>
    </th>
</tr>

    @if (session('delete_status'))
    <p style="text-align:center; color:green;"><b>{{ session('delete_status') }}</b></p>
    @endif
    
</div>

    <center>
    
    <table class='sortable' style='text-align: center; margin-top:2%'> 

    <tr>
        <th>Class Name</th>
        <th>Form Name</th>
        <th>Delete</th>
    </tr>

    @foreach($classes as $class)

<tr> 
    <td>
        <h4> {{ $class->class_name }} </h4>
    </td> 
    
    <td> 
        <h4> {{ $class->form_name }} </h4>         
    </td>  

    <td>
    <form action="{{route('deleteClass')}}" method="post" class="form-group"> 
        <input type = 'hidden' name = '_token' value = '<?php echo csrf_token(); ?>'>
        <input type = 'hidden' name = 'delete_class' value="{{ $class->class_name }}">
        <button class="button login_submit">
        <span class="button_text">Delete Class</span>
        </button>
    </form>
    </td>
</tr>

@endforeach

    </table>
    </div>
    

