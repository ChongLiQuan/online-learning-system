<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">

  <title>Student Dashboard</title>
  <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
  <link rel="stylesheet" href="<?php echo asset('css/homepage.css') ?>" type="text/css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{!! asset('/images/login_logo.jpeg') !!}" />
</head>

<?php
$username = Session::get('username');
$announcement = DB::table('announcement_status')->where('student_id', $username)->where('annouce_status', 0)->get();
$announcementCount = count($announcement);

$notification = DB::table('notification_list')->where('user_id', $username)->where('read_notification_status', 0)->get();
$notificationCount = count($notification);
?>

<body>
  <header id="pageHeader">

    <div class="header-left">
      <table>
        <tr>
          <th>
            <a href='/studentHomepage'><img src="{{URL::asset('/images/login_logo.jpeg')}}" height='50px' width='50px' /></a>
          </th>
          <th>
            <a href='/studentHomepage'><b>Online E-Learning System</b></a>
          </th>
        </tr>
      </table>
    </div>

    <div class="header-right">
      <b>
        <a>Welcome Back, {{ Session::get('user_full_name') }}. &nbsp;&nbsp; |</a>
        <a href="/studentHomepage">Home</a>
        <a href="/studentProfilePage">Profile</a>

        <a href="/notificationPage" class='notification'>Notification

          <?php if ($notificationCount > 0) { ?>
            <span class="badge">{{ $notificationCount }}</span>
          <?php } ?>
        </a>

        <a href="/studentAnnouncementPage" class='notification'>Announcement

          <?php if ($announcementCount > 0) { ?>
            <span class="badge">{{ $announcementCount }}</span>
          <?php } ?>

        </a>
        <a href="/logout">Logout</a>
        <a>|</a>
      </b>
    </div>
  </header>
</body>