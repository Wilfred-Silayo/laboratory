  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-white" id="main-header">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <p class="navbar-brand">D2 LABORATORY</p>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logout" href="#" role="button">
          <i class="fas fa-sign-out-alt"><span class="ms-1">log out</span></i>
        </a>
      </li>
      <!----modal component-->
    </ul>
  </nav>
  <x-modal title="Confirm Logout" body="Are you sure you want to logout?" route="logout" modal="logout" />

  <!-- /.navbar -->