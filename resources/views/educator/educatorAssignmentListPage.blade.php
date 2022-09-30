<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

@include('educator/educatorHeader')
@include('educator/educatorHomeSideBar')
<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<article id="fullArticle">
    <p class='edu_home_banner'><b>Student Notes Management</b></p>
    @if (session('error_status'))
    <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
    @endif

    @if (session('pass_status'))
    <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
    @endif

    <table class="assignment_list">
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
                Assignment Title
            </th>
            <th>
                Due Date
            </th>
            <th>
                Class
            </th>
            <th>
                Course Code
            </th>
            <th>
                Mark
            </th>
        </thead>

        @foreach($allAssignment as $all)
        <tr>
            <td>
                {{ $all->assignment_id }}
            </td>

            <td>
                {{ $all->assignment_title }}
            </td>

            <td>
                {{ $all->assignment_due_date }}
            </td>

            <td>
                {{ $all->class_name }}
            </td>

            <td>
                {{ $all->subject_code }}
            <td>
                <a href="{{ route('educatorViewSubmissionPage', ['assignment_id' => $all->assignment_id]) }}">
                    <button class="home_preview_button">Mark Assignment</button></a>
            </td>
        </tr>
        @endforeach
    </table>

</article>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('.assignment_list').DataTable({
        searching: true,
        ordering: false,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "ALL"]
        ]
    });
</script>