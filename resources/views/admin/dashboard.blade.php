@extends('admin.layouts.app')
@section('content')
    <!-- Counts Section -->
    <section class="dashboard-counts section-padding">
        <div class="container-fluid">
            <div class="row">
                <!-- Count item widget-->
                @can('user-list')
                    <a href="" class="col-xl-3 col-md-3 col-sm-6">
                        <div class="wrapper count-title d-flex">
                            <div class="icon"><i class="icon-user"></i></div>
                            <div class="name">
                                <strong class="text-uppercase">Users</strong>
                                <div class="count-number">{{$users}}</div>
                            </div>
                        </div>
                    </a>
                @endcan
            <!-- Count item widget-->
                @can('category-list')
                    <a href="" class="col-xl-3 col-md-3 col-sm-6">
                        <div class="wrapper count-title d-flex">
                            <div class="icon"><i class="icon-padnote"></i></div>
                            <div class="name">
                                <strong class="text-uppercase">Categories</strong>
                                <div class="count-number">{{$categories}}</div>
                            </div>
                        </div>
                    </a>
                @endcan
            <!-- Count item widget-->
                @can('tag-list')
                    <a href="" class="col-xl-3 col-md-3 col-sm-6">
                        <div class="wrapper count-title d-flex">
                            <div class="icon"><i class="icon-interface-windows"></i></div>
                            <div class="name">
                                <strong class="text-uppercase">Tags</strong>
                                <div class="count-number">{{$tags}}</div>
                            </div>
                        </div>
                    </a>
                @endcan
            <!-- Count item widget-->
                @can('post-list')
                    <a href="" class="col-xl-3 col-md-3 col-sm-6">
                        <div class="wrapper count-title d-flex">
                            <div class="icon"><i class="icon-check"></i></div>
                            <div class="name">
                                <strong class="text-uppercase">Posts</strong>
                                <div class="count-number">{{$posts}}</div>
                            </div>
                        </div>
                    </a>
                @endcan
            </div>
            <!-- All User -->
            @can('user-list')
                <div class="card">
                    <div class="card-body">
                        <h3>Users</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>Sr#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                </thead>
                                <tbody>
                                @foreach($allUsers as $user)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                {{$role->name}}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
            @can('category-list')
            <!-- All Categories -->
                <div class="card">
                    <div class="card-body">
                        <h3>Categories</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>Sr#</th>
                                <th>Name</th>
                                <th>Parent</th>
                                <th>Top Menu</th>
                                <th>Created By</th>
                                </thead>
                                <tbody>
                                @foreach($allCategories as $category)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            @if($category->parent)
                                                {{$category->parent->name}}
                                            @else
                                                Parent Category
                                            @endif
                                        </td>
                                        <td>
                                            @if($category->show_in_top_nav == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            {{$category->user->name}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
        <!-- All Posts -->
            @can('post-list')
                <div class="card">
                    <div class="card-body">
                        <h3>Posts</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>Sr#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Views</th>
                                <th>Status</th>
                                <th>Created By</th>
                                </thead>
                                <tbody>
                                @foreach($allPosts as $post)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>
                                            @foreach($post->categories as $postCategory)
                                                {{$postCategory->name.','}}
                                            @endforeach
                                        </td>
                                        <td>{{$post->view_count}}</td>
                                        <td>
                                            @if($post->status == 1)
                                                Publish
                                            @else
                                                Draft
                                            @endif
                                        </td>
                                        <td>
                                            {{$post->user->name}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
        <!-- All Tags -->
            @can('tag-list')
                <div class="card">
                    <div class="card-body">
                        <h3>Tags</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>Sr#</th>
                                <th>Name</th>
                                <th>Trending</th>
                                <th>Created By</th>
                                </thead>
                                <tbody>
                                @foreach($allTags as $tag)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$tag->name}}</td>
                                        <td>
                                            @if($tag->trending == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>
                                            {{$tag->user->name}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </section>

@endsection
@push('js')

@endpush
