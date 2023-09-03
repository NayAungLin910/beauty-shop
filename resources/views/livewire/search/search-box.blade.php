<li>

    <div class="flex items-center gap-2">
        <div wire:loading.delay class="max-w-[1rem]">
            <ion-icon wire:ignore name="reload-circle-outline" class="text-xl animate-spin mr-1"></ion-icon>
        </div>
        <div wire:loading.delay.remove class="max-w-[1rem]">
            <ion-icon wire:ignore name="search-outline" class="text-xl mr-1"></ion-icon>
        </div>

        <input wire:model.live.debounce.200ms='search' type="text" class="input-form-pink">
    </div>
    @if ($search)
    @if ($tags && $tags->count() || $products && $products->count())
    <div class="md:absolute ml-6 rounded-lg w-auto bg-white text-black shadow py-2 px-1 text-sm max-w-[20rem]">
        @if ($tags && $tags->count())
        <h2 class="text-pink-700 mb-2">Tags</h2>
        <div class="flex flex-wrap gap-2">
            @foreach ($tags as $tag)
            <a href="{{ route('products.view-pre', ['tagId' => $tag->id]) }}">
                <span class="p-1 bg-pink-700 hover:bg-pink-800 text-white shadow rounded-lg">{{ $tag->name }}</span>
            </a>
            @endforeach
        </div>
        @endif
        @if ($tags || $products)
        <hr class="border my-2 border-b-pink-700">
        @endif
        @if ($products && $products->count())
        <h2 class="text-pink-700 mb-2">Products</h2>
        <div class="">
            @foreach ($products as $product)
            <a href="{{ route('products.single', ['id' => $product->id]) }}">
                <div class="flex flex-col items-center gap-1 hover:bg-gray-200 rounded-xl p-2">
                    <img src="{{ asset('storage' . $product->image) }}" class="rounded-lg max-w-[10rem]"
                        alt="{{ $product->name }}'s image">
                    <p>
                        {{ $product->name }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
    @else
    <div class="md:absolute ml-6 rounded-lg w-auto bg-white text-black shadow py-2 px-1 text-sm max-w-[20rem]">
        No matching information found!
    </div>
    @endif
    @endif

</li>