<div class="d-flex">
    @can('keyword-edit')
        <a href="{{route('keyword.edit',$id)}}" class="edit btn btn-success btn-sm">Edit</a>
    @endcan
    @can('keyword-delete')
        <form class="ml-2" action="{{route('keyword.destroy',$id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit"class="btn btn-danger btn-sm" value="Delete"  onclick="return confirm('Are You Sure Want to Delete?')">
        </form>
    @endcan
</div>
