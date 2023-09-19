<div class="mx-1">
    <!-- Header -->
    <h1 class="text-2xl text-center my-2">Search Blogs</h1>

    <div class="my-2 flex flex-wrap items-center gap-2">
        <!-- Search Name -->
        <div>
            <label for="search">Search</label>
            <input wire:model.live.debounce.200ms='search' type="text" name="search" id="search"
                class="input-form-pink">
        </div>

        <!-- Reset -->
        <div>
            <button wire:click='resetFilter' wire:target='resetFilter'
                wire:loading.delay.class='opacity-30 animate-pulse' class="button-pink-rounded mt-4">Reset</button>
        </div>

    </div>

    <!-- blogs -->
    <div wire:loading.delay.remove class="my-2">
        <div class="flex flex-wrap items-center place-content-center gap-2">

            @if ($blogs && $blogs->count())
            @foreach ($blogs as $product)
            <a href="{{ route('blogs.single', ['id' => $product->id]) }}" wire:key="{{ $product->id }}">
                <div class="rounded-xl bg-slate-50 hover:bg-pink-100 shadow-lg w-[20rem]">
                    <img class="w-auto mx-auto rounded-t-xl" src="{{ asset('storage' . $product->image) }}" alt=""
                        loading="lazy">
                    <div class="p-3">
                        <p class="text-lg my-1">{{ $product->name }}</p>
                        <p class="truncate my-1">
                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="flex items-center p-2 gap-2">
                        <div>
                            <a href="{{ route('admin.blogs.edit', ['id' => $product->id]) }}"
                                class="button-green-rounded">Edit</a>
                        </div>


                        <button
                            onclick='openPopupSubmit("Are you sure about deleteing the blog, {{ $product->name }}?", "", true, "blog-delete", {{ $product->id }})'
                            class="button-pink-rounded">Delete</button>
                    </div>
                </div>
            </a>
            @endforeach
            @else
            <p class="text-lg">No blogs found!</p>
            @endif

        </div>
    </div>

    @if ($blogs && $blogs->count())
    <!-- Pagination -->
    <div wire:loading.delay.remove class="my-2">
        {{ $blogs->links() }}
    </div>
    @endif

    <!-- Loading -->
    <div class="my-2 flex place-content-center">
        <img wire:loading.delay class="max-w-[16rem]"
            src="{{ asset('storage/default_images/snail_loading.png!bw700') }}" alt="Loading Indicator Image" />
    </div>

</div>