<div class="d-flex">
    @can('user-edit')
        <a href="{{route('user.edit',$id)}}" class="edit btn btn-success btn-sm">Edit</a>
    @endcan
    @can('user-delete')
        <form class="ml-2" action="{{route('user.destroy',$id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit"class="btn btn-danger btn-sm" value="Delete"  onclick="return confirm('Are You Sure Want to Delete?')">
        </form>
    @endcan
</div>
