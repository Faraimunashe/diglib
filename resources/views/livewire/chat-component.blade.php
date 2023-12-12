<div>

    <ul class="list-unstyled">

        @foreach ($messages as $msg)
                    @if ($msg->user_id != Auth::id())
                        <li class="d-flex justify-content-between mb-4">
                            <img src="{{asset('images/user-icon.jpg')}}" alt="avatar"
                                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between p-3">
                                <p class="fw-bold mb-0">{{get_username($msg->user_id)}}</p>
                                <p class="text-muted small mb-0"><i class="far fa-clock"></i> {{$msg->created_at->diffForHumans()}}</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">{{$msg->content}}</p>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="d-flex justify-content-between mb-4">
                            <div class="card w-100">
                                <div class="card-header d-flex justify-content-between p-3">
                                <p class="fw-bold mb-0">{{get_username($msg->user_id)}}</p>
                                <p class="text-muted small mb-0"><i class="far fa-clock"></i> {{$msg->created_at->diffForHumans()}}</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">{{$msg->content}}</p>
                                </div>
                            </div>
                            <img src="{{asset('images/user-icon.jpg')}}" alt="avatar"
                                class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                        </li>
                    @endif
        @endforeach
        <li class="mb-3">
            <form wire:submit.prevent="sendMessage()">
                <label for="exampleFormControlTextarea1" class="form-label">Reply here</label>
                <textarea class="form-control" id="message" wire:model="message" rows="3"></textarea>
                <button type="submit" class="btn btn-primary mt-2 btn-rounded float-end">Send</button>
            </form>
        </li>
    </ul>
</div>
