<div class="d-flex">
    @can('playlist-edit')
        <a href="{{route('playlist.edit',$id)}}" class="edit btn btn-success btn-sm">Edit</a>
    @endcan
    @can('playlist-delete')
        <form class="ml-2" action="{{route('playlist.destroy',$id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit"class="btn btn-danger btn-sm" value="Delete"  onclick="return confirm('Are You Sure Want to Delete?')">
        </form>
    @endcan
</div>
