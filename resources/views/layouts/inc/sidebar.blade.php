<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">LMS App </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{route('home')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  @if (auth()->id() == 1)

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Settings</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Components:</h6>
          <a class="collapse-item" href="{{ route('department.index')}}">Departments</a>
          <a class="collapse-item" href="{{ route('category.index')}}">Users Category</a>
          <a class="collapse-item" href="{{ route('publicholiday.index')}}">Public Holidays</a>
          <a class="collapse-item" href="{{ route('users.index')}}">Users</a>
          <a class="collapse-item" href="{{ route('staffleaveentry')}}">Approved Leaves</a>
          <a class="collapse-item" href="{{ route('leave.getUser')}}">Users Leave</a>
          <a class="collapse-item" href="{{ route('leave.allUsersum')}}">All Summary</a>
        </div>
      </div>
    </li>
      
  @endif

  

  <!-- Nav Item - Utilities Collapse Menu -->

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->

  <!-- Nav Item - Pages Collapse Menu -->
  @if (auth()->id() != 1)()
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Administration</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Functions:</h6>
        <a class="collapse-item" href="{{ route('leave.index')}}">Leave Application</a>
        <a class="collapse-item" href="{{ route('leave.leaveSummary')}}">Summary</a>
        {{-- <a class="collapse-item" href="#">Messages</a> --}}
        
        @if (auth()->user()->permission == 'on')
            <a class="collapse-item" href="{{ route('leave.approval')}}">Approval Requests</a>
            <a class="collapse-item" href="{{ route('leave.allUsersum')}}">All Summary</a>

        @endif
        

      </div>
    </div>
  </li>

    <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
      
  @endif




  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>