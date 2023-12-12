<form action="{{ route('save-document') }}" method="POST">
    @csrf
    <textarea name="doc">
        Start writing!
    </textarea>

    <div class="card mt-2">
        <div class="card-body">
            <button type="submit" class="btn btn-primary" style="float: right;">Save document</button>
        </div>
    </div>
</form>
