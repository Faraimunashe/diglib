<x-app-layout>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block mt-3 mb-3">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="#">
                    <x-icon name="home" class="icon icon-xxs" />
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Archive</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$archive->title}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <x-alert />
        </div>
        <div class="col-4">
            <div class="card border-0 shadow">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <h2 class="fs-5 fw-bold mb-0">Archive Overview</h2>
                </div>
                <div class="card-body">
                    <div class="small"><b>Archive:</b> {{$archive->title}}</div>
                    <div class="small fw-bold">{{$archive->description}}</div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-0 shadow">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <h2 class="fs-5 fw-bold mb-0">List Of Sources</h2>
                    <a href="{{ route('create-document', $archive->id) }}" class="btn btn-sm btn-secondary">Create document</a>
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default">Upload Source</a>
                </div>
                <div class="card-body">
                    @foreach ($sources as $src)
                        <div class="row align-items-center d-block d-sm-flex border-bottom pb-4 mb-4">
                            <div class="col-auto mb-3 mb-sm-0">
                                <div class="calendar d-flex">
                                    <img src="{{asset('images/source.png')}}" >
                                </div>
                            </div>
                            <div class="col">
                                <a href="#"><h3 class="h5 mb-1">{{$src->title}}</h3></a>
                                <span class="badge bg-info">{{$src->source_type}}</span>
                                <div class="small fw-bold">{{$src->created_at->diffForHumans()}}</div>
                                @if ($src->source_type == 'website')
                                    <span class="small fw-bold">Visit:
                                        <a href="{{$src->details}}" target="_blank">
                                            <x-icon name="link" class="icon icon-xs me-2"/>
                                        </a>
                                    </span>
                                @elseif ($src->source_type == 'Digital Document')
                                    <span class="small fw-bold">Read:
                                        <a href="{{route('view-document', $src->details)}}" target="_blank">
                                            <x-icon name="book-open" class="icon icon-xs me-2"/>
                                        </a>
                                    </span>
                                @else
                                    <span class="small fw-bold">Open:
                                        <a href="{{route('download-source', ['file_name'=>$src->filename])}}" target="_blank">
                                            <x-icon name="book-open" class="icon icon-xs me-2"/>
                                        </a>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer border-top bg-gray-50">
                    {{$sources->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Upload Sources</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('add-source')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="archive_id" value="{{$archive->id}}" required>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Source Title <code>*</code> </label>
                            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Archive title" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Source Type <code>*</code> </label>
                            <select name="source_type" id="mySelect" class="form-control" id="exampleFormControlInput1" required>
                                <option selected disabled>__Select Source Type__</option>
                                <option value="book">Book</option>
                                <option value="picture">Picture</option>
                                <option value="website">Website</option>
                                <option value="video">Video</option>
                                <option value="audio">Audio</option>
                            </select>
                        </div>
                        <div class="mb-3" id="myDiv">
                            <label for="exampleFormControlInput1" class="form-label">Website URL<code>*</code> </label>
                            <input type="url" name="url" class="form-control" id="exampleFormControlInput1" placeholder="Archive title">
                        </div>
                        <div class="mb-3" id="myDiv2">
                            <label for="exampleFormControlInput1" class="form-label">Source File <code>*</code> </label>
                            <input type="file" name="file" class="form-control" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">Upload</button>
                        <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Get references to the select element and the div
        const selectElement = document.getElementById('mySelect');
        const divElement = document.getElementById('myDiv');
        const divElement2 = document.getElementById('myDiv2');
        divElement2.style.display = '';
        divElement.style.display = '';

        // Add an event listener to the select element
        selectElement.addEventListener('change', function () {
        // Check if the selected option is equal to "url"
        if (selectElement.value === 'website') {
            // If it is, hide the div by setting its display property to "none"
            divElement2.style.display = 'none';
            divElement.style.display = '';
        } else {
            // If it's not, show the div by setting its display property to an empty string
            divElement2.style.display = '';
            divElement.style.display = 'none';
        }
        });

    </script>
</x-app-layout>
