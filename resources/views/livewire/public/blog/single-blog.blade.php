<div class="my-2">
    <div class="rounded-2xl shadow-lg lg:w-1/3 mx-auto bg-pink-600">
        <img src="{{ asset('storage' . $blog->image) }}" class=" w-full rounded-t-2xl" alt="{{ $blog->name }}'s image">
        <div class="text-white p-3">
            <h1 class="text-xl text-center">{{ $blog->name }}</h1>
            <p class="my-2">
                {{ $blog->description }}
            </p>
        </div>
        <div class="flex place-content-between items-center p-3">
            <a class="button-white-rounded" href="{{ route('blogs.view') }}">
                Back
            </a>
        </div>
    </div>
</div>