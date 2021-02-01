<div class="d-flex">
    @can('show-details-edit')
        <a href="{{route('show-details.edit',$id)}}" class="edit btn btn-success btn-sm ml-2">Edit</a>
    @endcan
    @can('show-details-delete')
        <form class="ml-2" action="{{route('show-details.destroy',$id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit"class="btn btn-danger btn-sm" value="Delete"  onclick="return confirm('Are You Sure Want to Delete?')">
        </form>
    @endcan
</div>
