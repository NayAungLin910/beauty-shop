<div>
    <section>
        <div class="grid lg:grid-cols-3 grid-cols-1">

            <!-- Popular Porducts -->
            <div class="relative max-w-[25rem] mx-auto lg:mx-2 m-2 p-1 w-full">
                <h2 class="text-center text-xl my-1">Popular Products</h2>
                <div
                    class="bg-pink-100 h-[25rem] hover:bg-pink-200 flex overflow-x-auto scrollbar-hide-webkit scrollbar-hide-i snap-x snap-mandatory scroll-smooth shadow-lg rounded-xl">
                    @if ($popularProducts && $popularProducts->count())
                    @foreach ($popularProducts as $product)

                    <div id="slide-{{ $loop->index }}" class="flex-[1_0_100%] snap-start">
                        <a href="{{ route('products.single', ['id' => $product->id]) }}">
                            <img class="w-[25rem] max-h-[15rem]" src="{{ asset('storage' . $product->image) }}"
                                alt="The product, {{ $product->name }}'s image">
                        </a>
                        <a href="{{ route('products.single', ['id' => $product->id]) }}">
                            <div class="p-3 text-center">
                                <p class="my-1">
                                    {{ $product->name }}
                                </p>
                                <p class="my-1">
                                    {{ $product->price }} MMK
                                </p>
                                <div class="flex flex-wrap my-1 gap-1">
                                    @foreach ($product->tags as $tag)
                                    <a href="{{ route('products.view-pre', ['tagId' => $tag->id]) }}">
                                        <span
                                            class="bg-pink-300 text-sm hover:bg-pink-400 p-[0.1rem] text-black rounded-lg">
                                            {{ $tag->name }}
                                        </span>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </div>

                    @endforeach
                    @endif
                </div>
                <div class="slider-nav flex gap-x-4 absolute bottom-3 left-[50%] translate-x-[-50%] z-10">
                    @if ($popularProducts && $popularProducts->count())
                    @foreach ($popularProducts as $product)
                    <a href="#slide-{{ $loop->index }}"
                        class="w-3 h-3 rounded-full bg-black opacity-75 transition-transform ease-in-out hover:opacity-100"></a>
                    @endforeach
                    @endif
                </div>
            </div>

            <!-- Latest Products -->
            <div class="flex flex-col gap-y-2 justify-center rounded-lg my-2 p-2">
                <h2 class="text-center text-xl text-black">Latest Products</h2>
                @if ($latestProducts && $latestProducts->count())
                @foreach ($latestProducts as $product)
                <a href="{{ route('products.single', ['id' => $product->id]) }}"
                    class="flex gap-1 hover:bg-pink-200 rounded-lg bg-pink-100 shadow-lg">
                    <img class="max-w-[8rem] rounded-tl-lg rounded-bl-lg" src="{{ asset('storage' . $product->image) }}"
                        alt="The product, {{ $product->name }}'s image">
                    <div class="flex flex-col justify-center p-2">
                        <p>{{ $product->name }}</p>
                        <p>{{ $product->price }} MMK</p>
                    </div>
                </a>
                @endforeach
                @endif
            </div>

            <!-- Tags -->
            <div class="p-3 my-2">
                <h2 class="text-center my-2 text-xl">
                    Tags
                </h2>
                @if ($tags && $tags->count())
                <div class="flex flex-wrap gap-3">
                    @foreach ($tags as $tag)
                    <a href="{{ route('products.view-pre', ['tagId' => $tag->id]) }}">
                        <p class="p-2 rounded-lg bg-pink-500 hover:bg-pink-600 text-white">
                            {{ $tag->name }}
                        </p>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </section>
</div>