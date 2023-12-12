<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header border-bottom">
                    <h2 class="fs-5 fw-bold mb-0">User List</h2>
                </div>
                <div class="card-body py-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($users as $user)
                            <li class="list-group-item bg-transparent border-bottom py-3 px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <!-- Avatar -->
                                        <a href="{{ route('chat.show', $user->id) }}" class="avatar-md">
                                            <img class="rounded" alt="Image placeholder" src="{{ asset('images/user-icon.jpg') }}">
                                        </a>
                                    </div>
                                    <div class="col-auto px-0">
                                        <h4 class="fs-6 text-dark mb-0">
                                            <a href="{{ route('chat.show', $user->id) }}">{{$user->name}}</a>
                                        </h4>
                                        <span class="small">{{$user->email}}</span>
                                    </div>
                                    <div class="col text-end">
                                        <span class="fs-6 fw-bolder text-dark">
                                            <a href="{{ route('chat.show', $user->id) }}">
                                                <x-icon name="chat-bubble-bottom-center-text" />
                                                {{get_unread_messages($user->id)}}
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
