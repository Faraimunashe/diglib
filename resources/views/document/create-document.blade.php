<x-app-layout>
    <x-mce-header />
    <x-alert />
    <form action="{{ route('save-document',$archive_id) }}" method="POST">
        @csrf
        <textarea name="doc">
            Start writing!
        </textarea>

        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Filename" required>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary" style="float: right;">Save document</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>
