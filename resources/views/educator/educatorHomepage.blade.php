@include('educator/educatorHeader')
@include('educator/educatorHomeSideBar')


<article id="mainArticle">
    <p class='edu_home_banner'><b>Student Notes Management</b></p>
    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    <table class="note_list">
        <colgroup>
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 30%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
        </colgroup>

        <thead>
            <th>
                ID
            </th>
            <th>
                Note Title
            </th>
            <th>
                Subject ID
            </th>
            <th>
                Class 
            </th>
            <th>
                Student ID
            </th>
            <th>
                Preview
            </th>
        </thead>

        @foreach($notes as $n)
        <tr>
            <td>
                {{ $n->student_note_id }}
            </td>

            <td>
                {{ $n->student_note_name }}
            </td>

            <td>
                {{ $n->subject_code }}
            </td>

            <td>
                {{ $n->class_name }}
            </td>

            <td>
                <?php $student_name = DB::table('student_list')->where('student_id', $n->student_id)->pluck('student_name')->first(); ?>
                {{ $student_name }}

            <td>
                <a href="{{ route('educatorReviewNotePage', ['student_note_id' => $n->student_note_id]) }}">
                    <button class="home_preview_button">Preview</button></a>
            </td>
        </tr>
        @endforeach
    </table>

</article>
@include('educator/educatorHomeAnnouncementBar')

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('.note_list').DataTable({
        searching: true,
        ordering: false,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "ALL"]
        ]
    });
</script>