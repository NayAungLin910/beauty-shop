<div class="my-2">
    <div class="rounded-2xl shadow-lg lg:w-1/3 mx-auto bg-pink-600">
        <img src="{{ asset('storage' . $product->image) }}" class=" w-full rounded-t-2xl"
            alt="{{ $product->name }}'s image">
        <div class="text-white p-3">
            <h1 class="text-xl text-center">{{ $product->name }}</h1>
            <p class="my-2">
                {{ $product->price }} MMK
            </p>
            <p class="my-2">
                {{ $product->description }}
            </p>
            <div class="flex flex-wrap mt-3 gap-1">
                @foreach ($product->tags as $tag)
                <a href="{{ route('products.view-pre', ['tagId' => $tag->id]) }}">
                    <span class="bg-pink-200 hover:bg-pink-400 p-1 text-black text-sm rounded-lg">
                        {{ $tag->name }}
                    </span>
                </a>
                @endforeach
            </div>
            @if ($cart)
            <div class="mt-4">
                <span class="rounded-xl p-2 bg-black shadow">
                    In Cart: {{ $cart }}
                </span>
            </div>
            @endif
        </div>
        <div class="flex place-content-between items-center p-3" x-data="{ cart: false }">
            <a class="button-white-rounded" href="{{ route('products.view') }}">
                Back
            </a>
            @if(Auth::check() && Auth::user()->role === '1')
            <div class="flex items-center place-content-end gap-2" x-show="cart">
                <button x-on:click="cart = !cart" class="button-white-rounded">Cancel</button>
                <input type="number" value="1" id="product-{{ $product->id }}-quantity" min="1" step="1"
                    class="input-form-pink w-1/3">
                <button x-on:click="cart = !cart" onclick="addCart({{ $product->id }})"
                    class="button-green-rounded">Add</button>
            </div>
            <button x-show="!cart" x-on:click="cart = !cart" class="button-white-rounded">Add to Cart</button>
            @endif

        </div>
    </div>

    @push('layout-script-stack')
    <script>
        function addCart(id) {
            const quantity = document.querySelector(`#product-${id}-quantity`).value;
            Livewire.dispatch('add-cart', {id:id, quantity: quantity})
        }
    </script>
    @endpush
</div>