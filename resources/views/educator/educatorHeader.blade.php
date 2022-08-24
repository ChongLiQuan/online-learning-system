<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">

  <title>Educator Dashboard</title>
  <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
  <link rel="stylesheet" href="<?php echo asset('css/homepage.css') ?>" type="text/css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{!! asset('/images/login_logo.jpeg') !!}" />
</head>

<body>

  <header id="pageHeader">
    <a href='/educatorHomepage'><img src='images/login_logo.jpeg' height=30 width=30></a><b>Online E-Learning System</b>
    <div class="header-right">
    <a href="/educatorHomepage">Home</a>
      <a href="/educatorProfile">Profile</a>
      <a href="/educatorProfile">Annoucement</a>
      <a href="/logout">Logout</a>
    </div>
  </header>