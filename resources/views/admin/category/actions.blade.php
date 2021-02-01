<div class="d-flex">
    @can('category-edit')
    <a href="{{route('category.edit',$id)}}" class="edit btn btn-success btn-sm">Edit</a>
    @endcan
    @can('category-delete')
    <form class="ml-2" action="{{route('category.destroy',$id)}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit"class="btn btn-danger btn-sm" value="Delete"  onclick="return confirm('Are You Sure Want to Delete?')">
    </form>
    @endcan
</div>
