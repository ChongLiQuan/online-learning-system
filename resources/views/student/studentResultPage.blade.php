<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

@include('student/studentHeader')
@include('student/studentLeftSideBar')

<link rel="stylesheet" href="<?php echo asset('css/courseHomepage.css') ?>" type="text/css">

<article id="mainArticle">
    <p class="stu_home_banner">Coursework Marks</p>
    <table class='profileInformation' border=0>
        <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 30%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 55%;">
        </colgroup>

        <thead>
            <tr>
                <th>ID</td>
                <th>Assignment Title</th>
                <th>Mark</th>
                <th>Educator Feedback</th>
            </tr>
        </thead>

        @foreach($allAssignment as $a)
        <tr>
            <td>
                {{$a->submission_id}}
            </td>
            <td>
                {{$a->assignment_title}}
            </td>

            <!-- Row to display assignment mark -->
            <!-- This is to check if the assignment is unmarked -->
            <?php if ($a->submission_mark == null) { ?>
                <td style="color:orange;">
                    Pending
                </td>
                <!-- Else case if the assignment has been marked, display the mark -->
            <?php } else { ?>
                <td>
                    {{$a->submission_mark}} / {{$a->assignment_full_mark}} Marks
                </td>
            <?php } ?>

            <!-- Row to display educator comment -->
            <!-- This is to check if the submission is mark, show the educator comment pending -->
            <?php if ($a->submission_mark == null) { ?>
                <td style="color:orange;">
                    Pending
                </td>
            <?php } ?>

            <!-- If the assignment has been marked check if there is any educator comment -->
            <?php if ($a->submission_mark != null) { ?>
                <?php if ($a->submission_educator_feedback == null) { ?>
                    <td>
                        No Feedback
                    </td>
                <?php } else { ?>
                    <td>
                        {{$a->submission_educator_feedback}}
                    </td>
            <?php }
            } ?>
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
    $('.profileInformation').DataTable({
        searching: true,
        ordering: false,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "ALL"]
        ]
    });
</script>