<div class="d-flex">
    @can('show-edit')
        <a href="{{route('show.edit',$id)}}" class="edit btn btn-success btn-sm ml-2">Edit</a>
    @endcan
    @can('show-delete')
        <form class="ml-2" action="{{route('show.destroy',$id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit"class="btn btn-danger btn-sm" value="Delete"  onclick="return confirm('Are You Sure Want to Delete?')">
        </form>
    @endcan
</div>
