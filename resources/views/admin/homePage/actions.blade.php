<div class="d-flex">
    @can('homepage-edit')
        <a href="{{route('homePage.edit',$id)}}" class="edit btn btn-success btn-sm">Edit</a>
    @endcan
</div>
