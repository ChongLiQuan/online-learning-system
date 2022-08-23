@include('educator/educatorHeader')

<div class="header">
  <a href="#default" class="logo">CompanyLogo</a>
  <div class="header-right">
    <a class="active" href="#home">Home</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>

<span class="dashboard">Educator Dashboard</span>

<span class="admin_name">Welcome back, {{ Session::get('username') }}.</span>
