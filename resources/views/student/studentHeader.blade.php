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

<body>

  <header id="pageHeader">
    <div class="header-left">
      <a href='/studentHomepage'><b>Online E-Learning System</b></a>
    </div>

    <div class="header-right">
      <b>
        <a href="/studentHomepage">Home</a>
        <a href="/">Profile</a>
        <a href="/studentAnnoucement" class='notification'>Annoucement
          <span class="badge">3</span>
        </a>
        <a href="/logout">Logout</a>
      </b>
    </div>
  </header>
</body>