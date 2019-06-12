<main class="py-4">
    <nav id="mySidenav" class="sidenav">
        <div class = sibar-header>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <div class = "sibar-img" style = "display: flex;border-top: 1px solid #3a3f48;">
            <div style = "padding:10px 20px;">
                <img class = "img-responsive img-rounded" src = "/uploads/{{ Auth::user()->avatar }}" style = "width:50px;height:50px; border-radius: 50%;">
            </div>
            <div class="user-info" >
                <span class="user-name">
                    {{ Auth::user()->name }}
                </span>
                <br>
                <span class="user-role">User</span>
                <!-- <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>Online</span>
                </span> -->
            </div>
        </div>
        <div class = "sidebar-menu" style = "border-top: 1px solid #3a3f48;">
            <div style = "padding:10px 20px;">
                <a href="/home"><i class="fas fa-home"></i>Home</a>
                <a href="/profile"><i class="fas fa-id-card"></i>Profile</a>
                <a href="/message"><i class="fas fa-comments"></i>Blog</a>
                <a href="#">Test2</a>
            </div>
        </div>
    </nav>
</main>
<!-- Use any element to open the sidenav -->
<span onclick="openNav()"><i id = "open_icon" class="fas fa-align-justify fa-3x"></i></span>

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<div id="main">
  @yield('content')
</div>
