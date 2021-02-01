<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center">
                {{--                <img src="{{asset('backend/img')}}/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">--}}
                <h2 class="h5">{{Auth::user()->name}}</h2>
                <span>
                    @foreach(Auth::user()->roles as $role)
                        {{$role->name}}
                    @endforeach
                </span>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo">
                <a href="{{route('dashboard')}}" class="brand-small text-center">
                    <img src="{{asset('backend/img')}}/favicon.png" alt="">
                </a>
            </div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="icon-home"></i>Dashboard
                    </a>
                </li>
                @canany(['role-list','role-create'])
                    <li>
                        <a href="#role" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-user"></i>Role
                        </a>
                        <ul id="role" class="collapse list-unstyled">
                            @can('role-create')
                                <li><a href="{{route('role.create')}}">Create</a></li>
                            @endcan
                            @can('role-list')
                                <li><a href="{{route('role.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['user-list','user-create'])
                    <li>
                        <a href="#user" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-user"></i>User
                        </a>
                        <ul id="user" class="collapse list-unstyled">
                            @can('user-create')
                                <li><a href="{{route('user.create')}}">Create</a></li>
                            @endcan
                            @can('user-list')
                                <li><a href="{{route('user.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @can('homepage-list')
                    <li>
                        <a href="#homePage" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-user"></i>Home Section
                        </a>
                        <ul id="homePage" class="collapse list-unstyled">
                            <li><a href="{{route('homePage.index')}}">View All</a></li>
                        </ul>
                    </li>
                @endcan
                @can('contact-list')
                    <li>
                        <a href="#contact" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-user"></i>Contact
                        </a>
                        <ul id="contact" class="collapse list-unstyled">
                            <li><a href="{{route('contact.index')}}">View All</a></li>
                        </ul>
                    </li>
                @endcan
                @canany(['playlist-list','playlist-create'])
                    <li>
                        <a href="#playlist" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-padnote"></i>Playlist
                        </a>
                        <ul id="playlist" class="collapse list-unstyled">
                            @can('playlist-create')
                                <li><a href="{{route('playlist.create')}}">Create</a></li>
                            @endcan
                            @can('playlist-list')
                                <li><a href="{{route('playlist.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['category-list','category-create'])
                    <li>
                        <a href="#category" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-padnote"></i>Category
                        </a>
                        <ul id="category" class="collapse list-unstyled">
                            @can('category-create')
                                <li><a href="{{route('category.create')}}">Create</a></li>
                            @endcan
                            @can('category-list')
                                <li><a href="{{route('category.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['tag-list','tag-create'])
                    <li>
                        <a href="#tag" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-interface-windows"></i>Tag
                        </a>
                        <ul id="tag" class="collapse list-unstyled">
                            @can('tag-create')
                                <li><a href="{{route('tag.create')}}">Create</a></li>
                            @endcan
                            @can('tag-list')
                                <li><a href="{{route('tag.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['keyword-list','keyword-create'])
                    <li>
                        <a href="#keyword" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-interface-windows"></i>Focus Keywords
                        </a>
                        <ul id="keyword" class="collapse list-unstyled">
                            @can('keyword-create')
                                <li><a href="{{route('keyword.create')}}">Create</a></li>
                            @endcan
                            @can('keyword-list')
                                <li><a href="{{route('keyword.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['post-list','post-create'])
                    <li>
                        <a href="#posts" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-check"></i>Post
                        </a>
                        <ul id="posts" class="collapse list-unstyled">
                            @can('post-create')
                                <li><a href="{{route('post.create')}}">Create</a></li>
                            @endcan
                            @can('post-list')
                                <li><a href="{{route('post.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['show-list','show-create'])
                    <li>
                        <a href="#show" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-check"></i>Show
                        </a>
                        <ul id="show" class="collapse list-unstyled">
                            @can('show-create')
                                <li><a href="{{route('show.create')}}">Create</a></li>
                            @endcan
                            @can('show-list')
                                <li><a href="{{route('show.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['show-details-list','show-details-create'])
                    <li>
                        <a href="#show-details" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-check"></i>Show Details
                        </a>
                        <ul id="show-details" class="collapse list-unstyled">
                            @can('show-details-create')
                                <li><a href="{{route('show-details.create')}}">Create</a></li>
                            @endcan
                            @can('show-details-list')
                                <li><a href="{{route('show-details.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['program-list','program-create'])
                    <li>
                        <a href="#program" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-check"></i>Program
                        </a>
                        <ul id="program" class="collapse list-unstyled">
                            @can('program-create')
                                <li><a href="{{route('program.create')}}">Create</a></li>
                            @endcan
                            @can('program-list')
                                <li><a href="{{route('program.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['program-details-list','program-details-create'])
                    <li>
                        <a href="#program-details" aria-expanded="false" data-toggle="collapse">
                            <i class="icon-check"></i>Program Details
                        </a>
                        <ul id="program-details" class="collapse list-unstyled">
                            @can('program-details-create')
                                <li><a href="{{route('program-details.create')}}">Create</a></li>
                            @endcan
                            @can('program-details-list')
                                <li><a href="{{route('program-details.index')}}">View All</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
            </ul>
        </div>
    </div>
</nav>
