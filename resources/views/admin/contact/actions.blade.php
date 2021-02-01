<div class="d-flex">
    @can('contact-show')
        <a href="{{route('contact.show',$id)}}" class="edit btn btn-success btn-sm">Show</a>
    @endcan
    @can('contact-delete')
        <form class="ml-2" action="{{route('contact.destroy',$id)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit"class="btn btn-danger btn-sm" value="Delete"  onclick="return confirm('Are You Sure Want to Delete?')">
        </form>
    @endcan
</div>
