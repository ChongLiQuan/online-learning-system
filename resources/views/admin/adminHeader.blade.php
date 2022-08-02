<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">

    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo asset('css/adminHomepage.css')?>" type="text/css"> 
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{!! asset('images/school_logo.png') !!}"/>
   </head>
<body>
  <div class="sidebar">
    @include('admin/adminSidebar')
  </div>

  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Admin Dashboard</span>
      </div>
      <div class="profile-details">
        <span class="admin_name">Welcome back, {{ Session::get('username') }}.</span>
      </div>
    </nav>
