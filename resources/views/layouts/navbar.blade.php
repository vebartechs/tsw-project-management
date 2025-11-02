        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo text-center" >
                            {{-- <a href="{{url('/')}}"><img src="{{asset('assets/images/logo/new_logo.png')}}" alt="Logo" ></a> --}}
                            <a href="{{url('/')}}" class="logo-text">The Sparkling Wedding</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        {{-- Dashboard Nav --}}
                        <li class="sidebar-item ">
                            <a href="/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        
                        {{-- Project Nav --}}
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Projects</span>
                            </a>
                            {{-- <ul class="submenu " >
                               
                                <li class="submenu-item ">
                                    <a href="{{route('customer.basic.form')}}">Create Project</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="/dashboard">Project List</a>
                                </li>
                               
                                
                            </ul> --}}
                        </li>
                        <li class="sidebar-item ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Employee</span>
                                <span>Employee List</span>
                            </a>
                        </li>
                        {{-- customer --}}
                        <li class="sidebar-item  has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Customer</span>
                            </a>
                            <ul class="submenu" >
                                <li class="submenu-item ">
                                    <a href="">Customer List</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="">Customer Add</a>
                                </li>
                                
                            </ul>
                        </li>

                        
                        {{-- Employee --}}
                        {{-- <li class="sidebar-item  has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Employee</span>
                            </a>
                            <ul class="submenu " >
                                <li class="submenu-item ">
                                    <a href="{{route('employee.add')}}">Add Employee</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route('employee.list')}}">Employee List</a>
                                </li>

                            </ul>
                        </li> --}}
                        

                       

                        {{-- lOGOUT  --}}
                        <li class="sidebar-item  ">
                            <a href="{{ route('logout') }}" class='sidebar-link'>
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>