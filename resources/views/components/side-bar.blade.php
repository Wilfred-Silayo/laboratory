 <!-- Main Sidebar Container -->
 <aside class="main-sidebar bg-white text-dark elevation-1">
   <!-- Brand Logo -->
   <a href="index3.html" class="brand-link">
     <img src="{{asset('favicon.jpg')}}" alt="Lab Logo" class=" w-25 rounded elevation-3 " style="opacity: .8">
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="{{asset('storage/profile_images/'.auth()->user()->profile_pic)}}" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="{{route('profile.edit')}}" class="d-block fw-bold">{{auth()->user()->name}}</a>
       </div>
     </div>


     <!-- Sidebar Menu -->
     <nav class="mb-5">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         <x-nav-link route="dashboard" icon="tachometer-alt" title="Dashboard" />

         <li class="nav-header fw-bold">MAIN</li>
         @if(auth()->user()->privileges->add_patient)
         <x-nav-link route="patients.index" icon="circle" title="Patients" />
         @endif

         @if(auth()->user()->privileges->add_consultation)
         <x-nav-link route="consultations.index" icon="edit" title="Consultations" />
         @endif

         @if(auth()->user()->privileges->add_account)
         <x-nav-link route="accounts.index" icon="money-bill-wave" title="Accounts" />
         @endif

         @if(auth()->user()->privileges->create_lab_report)
         <x-nav-link route="labreports.index" icon="flask" title="Laboratory" />
         @endif

         <li class="nav-header fw-bold">SETTINGS</li>
         <x-nav-link route="profile.edit" icon="user" title="Profile" />

         <x-nav-link route="password.index" icon="ellipsis-h" title="Password" />

         <li class="nav-header fw-bold">MISCELLANEOUS</li>

         @if(auth()->user()->privileges->view_reports)
         <x-nav-link route="reports.index" icon="columns" title="Reports" />
         @endif

         @if(auth()->user()->privileges->add_test)
         <x-nav-link route="tests.index" icon="vials" title="Test Prices" />
         @endif

         <li class="nav-header fw-bold">SYSTEM</li>
         @if(auth()->user()->privileges->delete_system)
         <x-nav-link route="users.data" icon="user" title="Users" />
         <x-nav-link route="system.index" icon="tools" title="System Settings" class="mb-4" />
         @endif

       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>