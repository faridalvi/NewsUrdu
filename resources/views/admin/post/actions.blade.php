<div class="d-flex">
    @can('post-edit')
        <a href="{{route('post',$slug)}}" class="edit btn btn-warning btn-sm" target="_blank">View</a>
    @endcan
    @can('post-edit')
        <a href="{{route('post.edit',$id)}}" class="edit btn btn-success btn-sm ml-2">Edit</a>
    @endcan
    @can('post-delete')
        <form class="ml-2" action="{{route('post.destroy',$id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit"class="btn btn-danger btn-sm" value="Delete"  onclick="return confirm('Are You Sure Want to Delete?')">
        </form>
    @endcan
</div>
