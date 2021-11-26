<div class="flex justify-content-center px-8">
    <div class="w-4/6">
        <h1 class="my-2 text-3xl">Comments</h1>

        @error('newComment') <span class="text-red-500 text-xs">{{$message}}</span> @enderror

        <div class="mt-4">
            @if (session()->has('message'))

                <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        {{-- Upload Image --}}
        <section>

            @if ($image)
                <img src="{{$image}}" alt="image" width="200" class="shadow border rounded">
            @endif

            <input type="file" id="image" wire:change="$emit('fileChoosen')">
        </section>

        <form class="my-4 flex" wire:submit.prevent="addComment">
            {{-- {{$newComment}} --}}
            <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="what's in your mind." wire:model.debounce.500ms="newComment">

            <div class="py-2">
                <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
            </div>
        </form>

        <p>{{$newComment}}</p>

        @foreach ($comments as $comment)

            <div class="rounded border shadow p-3 my-2">
                <div class="flex justify-start my-2">
                    <p class="font-bold text-lg">{{$comment->user->name}}</p>
                    <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{$comment->created_at->diffForHumans()}}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-200 hover:text-red-600 cursor-pointer float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" wire:click="remove({{$comment->id}})" />
                </svg>
                <p class="text-gray-800">{{$comment->body}}</p>

                @if ($comment->image)
                    <img src="{{$comment->imagePath}}" alt="image" width="200">
                @endif
            </div>
        @endforeach
        <div class="mb-5">
         {{$comments->links('pagination-link')}}
        </div>
    </div>
</div>

{{-- Upload Image --}}
<script>
    // console.log(window);
    window.livewire.on('fileChoosen', () => {

       let inputField = document.getElementById('image')

       let file = inputField.files[0]

       let reader = new FileReader();

       reader.onloadend = () => {

            window.livewire.emit('fileUpload',reader.result)

       }

       reader.readAsDataURL(file);
    })
</script>
