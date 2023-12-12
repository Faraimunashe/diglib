<x-app-layout>
    <div class="py-4">
        <button class="btn btn-gray-800 d-inline-flex align-items-center me-2 dropdown-toggle" data-bs-toggle="modal" data-bs-target="#modal-default">
            <x-icon name="plus" class="icon icon-xs me-2" />
            New Archive
        </button>
    </div>
    <div class="row">
        <div class="col-12">
            <x-alert />
        </div>
        @foreach ($archives as $archive)
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                    <x-icon name="folder" class="icon icon-md" />
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">{{Str::limit($archive->title, 25)}}</h2>
                                </div>
                                <small class="d-flex align-items-center">
                                    {{$archive->created_at->diffForHumans()}}
                                </small>
                                <div class="small d-flex mt-1">
                                    <a href="{{route('archive', $archive->id)}}">
                                        <x-icon name="eye" class="icon icon-xs text-primary" />
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-update{{$archive->id}}">
                                        <x-icon name="pencil-square" class="icon icon-xs text-secondary" />
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-delete{{$archive->id}}">
                                        <x-icon name="trash" class="icon icon-xs text-danger" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-update{{$archive->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="h6 modal-title">Update Archive</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('update-archive',$archive->id)}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Title <code>*</code> </label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{$archive->title}}" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description <code>*</code></label>
                                    <input type="text" name="description" class="form-control" id="exampleFormControlInput1" value="{{$archive->description}}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary">Create</button>
                                <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-delete{{$archive->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="h6 modal-title">Delete Archive</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('delete-archive',$archive->id)}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p>You are about to delete an archive with title: <i>{{$archive->title}}</i> from the system, are you sure?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Yes delete</button>
                                <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($archives->isEmpty())
            <div class="col-12 mb-10">
                <div class="alert alert-gray-800 alert-dismissible fade show" role="alert">
                    <span class="fas fa-bullhorn me-1"></span>
                    <strong>No Archives Available!</strong> You should create one to see them list here.
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Create New Archive</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('create-archive')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Title <code>*</code> </label>
                            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Archive title">
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description <code>*</code></label>
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">Create</button>
                        <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
