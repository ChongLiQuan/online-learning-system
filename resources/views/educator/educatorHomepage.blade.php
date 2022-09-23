@include('educator/educatorHeader')
@include('educator/educatorHomeSideBar')


<article id="mainArticle">
    <p class='edu_home_banner'><b>Student Notes Management</b></p>

    <hr>

    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    <table border='0' style=' width:100%; text-align:center'>
        <tr>
            <td>
                <form action="{{route('eduFilterSubject')}}" method="post" class="form-group">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <select name='filter_id' class="field_input">
                        <option class="field_input" name="filter_id">By Subject Code</option>
                        @foreach($subjects as $s)
                        <option name="filter_id" value="{{ $s->subject_code }}"> {{ $s->subject_code }}</option>
                        @endforeach
                    </select>

                    <button class="button field_button">
                        <span class="button_text">Search</span>
                    </button>
                </form>
            </td>

            <td>
                <form action="{{route('eduFilterClass')}}" method="post" class="form-group">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <select name='filter_id' class="field_input">
                        <option name="filter_id">By Class</option>
                        @foreach($classes as $c)
                        <option name="filter_id" value="{{ $c->class_name }}"> {{ $c->class_name }}</option>
                        @endforeach
                    </select>

                    <button class="button field_button">
                        <span class="button_text">Search</span>
                    </button>
                </form>
            </td>

            <td>
                <form action="educatorHomepage">
                    <button class="button field_button">
                        <span class="button_text">Display All</span>
                </form>
            </td>
        </tr>
    </table>


    <table class='note_list' border=0 width='100%'>
        <colgroup>
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 30%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
        </colgroup>

        <th>
            <p>ID</p>
        </th>
        <th>
            <p>Note Title</p>
        </th>
        <th>
            <p>Subject ID</p>
        </th>
        <th>
            <p>Class </p>
        </th>
        <th>
            <p>Student ID</p>
        </th>
        <th>
            <p>Preview</p>
        </th>

        @foreach($notes as $n)

        <tr>
            <td style="text-align: center;">
                <p>{{ $n->student_note_id }}</p>
            </td>

            <td style="text-align: center;">
                <p>{{ $n->student_note_name }}</p>
            </td>

            <td style="text-align: center;">
                <p>{{ $n->subject_code }}</p>
            </td>

            <td style="text-align: center;">
                <p>{{ $n->class_name }}</p>
            </td>

            <td style="text-align: center;">
                <?php $student_name = DB::table('student_list')->where('student_id', $n->student_id)->pluck('student_name')->first(); ?>
                <p>{{ $student_name }}</p>
            </td>

            <td style="text-align: center;">
                <button class="add_folder_button">
                    <a href="{{ route('educatorReviewNotePage', ['student_note_id' => $n->student_note_id]) }}">
                        <span class="button_text">Preview</span></a>
                </button>
            </td>
            @endforeach

        </tr>

    </table>

</article>

@include('educator/educatorHomeAnnouncementBar')