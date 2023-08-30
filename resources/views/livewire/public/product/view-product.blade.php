<div class="mx-1">
    <!-- Header -->
    <h1 class="text-2xl text-center my-2">Search Products</h1>

    <div class="my-2 flex flex-wrap items-center gap-2">
        <!-- Search Name -->
        <div>
            <label for="search">Search</label>
            <input wire:model.live.debounce.200ms='search' type="text" name="search" id="search"
                class="input-form-pink">
        </div>

        <!-- Sort By -->
        <div>
            <label for="search">Sort</label>
            <select wire:model.live.debounce.200ms='sort' class="input-form-pink bg-white p-1" name="sort" id="">
                <option value="latest">Latest</option>
                <option value="oldest">Oldest</option>
            </select>
        </div>

        <!-- Min Price -->
        <div class="max-w-[10rem]">
            <label for="min">Minimum Price</label>
            <input id="min" min="0" name="min" wire:model.live.debounce.200ms='min' type="number"
                class="input-form-pink" step="1">
        </div>

        <!-- Max Price -->
        <div class="max-w-[10rem]">
            <label for="max">Maximum Price</label>
            <input id="max" min="0" name="max" wire:model.live.debounce.200ms='max' type="number"
                class="input-form-pink" step="1">
        </div>

        <!-- Reset -->
        <div>
            <button wire:click='resetFilter' wire:target='resetFilter'
                wire:loading.delay.class='opacity-30 animate-pulse' class="button-pink-rounded mt-4">Reset</button>
        </div>

    </div>

    <!-- Products -->
    <div wire:loading.delay.remove class="my-2">
        <div class="flex flex-wrap items-center place-content-center gap-2">

            @foreach ($products as $product)
            <a href="{{ route('products.single', ['id' => $product->id]) }}">
                <div class="rounded-xl bg-slate-50 hover:bg-pink-100 shadow-lg w-[20rem]">
                    <img class="w-auto mx-auto rounded-t-xl" src="{{ asset('storage' . $product->image) }}" alt=""
                        loading="lazy">
                    <div class="p-3">
                        <p class="text-lg my-1">{{ $product->name }}</p>
                        <p class="text-lg my-1">{{ $product->price }} MMK</p>
                        <p class="truncate my-1">
                            {{ $product->description }}
                        </p>

                        @if (Auth::check() && $product->orders()->where('user_id', Auth::user()->id)->first())
                        <div class="mt-4">
                            <span class="rounded-xl p-2 bg-black shadow text-white">
                                In Cart: {{ $product->orders()->where('user_id', Auth::user()->id)->first()->quantity }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach

        </div>
    </div>

    @if ($products->count())
    <!-- Pagination -->
    <div wire:loading.delay.remove class="my-2">
        {{ $products->links() }}
    </div>
    @endif

    <!-- Loading -->
    <div class="my-2 flex place-content-center">
        <img wire:loading.delay class="max-w-[16rem]"
            src="{{ asset('storage/default_images/snail_loading.png!bw700') }}" alt="Loading Indicator Image" />
    </div>

</div>