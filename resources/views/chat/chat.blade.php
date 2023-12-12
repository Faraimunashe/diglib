<x-app-layout>
    <section style="background-color: #eee;">
        <div class="container py-5">

          <div class="row">

            <div class="col-md-12">
                @livewire('chat-component', ['chat_id' => $chat->id])


            </div>

          </div>

        </div>
    </section>
</x-app-layout>
