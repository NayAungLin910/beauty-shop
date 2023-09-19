<div class="">

    <!-- Header --->
    <h1 class="text-2xl text-center my-2">Your Cart 2</h1>

    <div class="my-2 mx-1 flex gap-2">
        <!-- Description -->
        <div class="my-2 md:w-1/3">
            <label for="description">Description</label>
            <textarea class="input-form-pink h-28" name="description" id="description"
                wire:model='description'></textarea>
            @error('description')
            <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Destination -->
        <div class="my-2 md:w-1/3">
            <label for="destination">Destination</label>
            <textarea class="input-form-pink h-28" name="destination" id="destination"
                wire:model='destination'></textarea>
            @error('destination')
            <span class="text-red-600 bg-white w-auto rounded p-1">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="p-2 flex flex-wrap gap-2">

        <!-- Sort By -->
        <div>
            <label for="search">Sort</label>
            <select class="input-form-pink bg-white p-1" name="sort" wire:model.live.debounce.200ms='sort' id="">
                <option value="latest">Latest</option>
                <option value="oldest">Oldest</option>
            </select>
        </div>

    </div>

    <!-- orders Table -->
    <div wire:loading.delay.short.remove wire:target="sort" class="overflow-auto rounded-lg shadow-md m-2 my-3">
        <table class="w-full border-collapse border bg-pink-100 border-pink-100">
            <thead class="border-b text-lg border-pink-100">
                <tr>
                    <th class="table-th">Product Name</th>
                    <th class="table-th">Price</th>
                    <th class="table-th">Quantity</th>
                    <th class="table-th">Created At</th>
                    <th class="table-th">Subtotal Price</th>
                    <th class="table-th w-auto"></th>
                </tr>
            </thead>
            <tbody class="border-b border-pink-100">
                @if ($orders->count())
                @foreach ($orders as $order)
                <tr class="border-b group/order hover:bg-pink-200 border-pink-100" wire:key="{{ $order->id }}">
                    <td class="table-td">
                        {{ $order->product->name }}
                    </td>
                    <td class="table-td">
                        {{ $order->product->price }}
                    </td>
                    <td class="table-td flex items-center w-[9rem]">
                        <span class="block group-hover/order:hidden">{{ $order->quantity }}</span>
                        <input id="order-{{ $order->id }}-quantity" value="{{ $order->quantity }}" type="number" min="1"
                            step="1" class="input-form-pink p-1 w-12 m-0 hidden group-hover/order:block">
                        <button onclick="updateOrderQuantity({{ $order->id }})"
                            class="button-white-rounded ml-5 duration-0 text-sm invisible group-hover/order:visible">Save</button>
                    </td>
                    <td class="table-td">
                        {{ $order->created_at }}
                    </td>
                    <td class="table-td">
                        {{ $order->sub_price }}
                    </td>
                    <td class="table-td w-auto">
                        <button wire:click="delete({{ $order->id }})" wire:target='delete'
                            wire:loading.delay.short.class='opacity-30 animate-pulse'
                            class="button-pink-rounded text-xl invisible group-hover/order:visible duration-0">
                            <ion-icon wire:ignore name="trash-outline"></ion-icon>
                        </button>
                    </td>
                </tr>
                @endforeach
                <!-- Total Price -->
                <tr class="border-b hover:bg-pink-200 border-pink-100">
                    <td class="table-td" colspan="3"></td>
                    <td class="table-td text-end">
                        Total Price
                    </td>
                    <td class="table-td">
                        <div class="flex items-center place-content-between gap-2">
                            <span>
                                {{ $totalPrice }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <button
                            onclick='openPopupSubmit("Are you sure about buying the products in the cart?", "", false, "product-buy", 0)'
                            class="button-pink-rounded flex items-center gap-1">
                            <ion-icon wire:ignore name="wallet-outline" class="text-xl"></ion-icon>
                            Buy
                        </button>
                    </td>
                </tr>
                @else
                <tr class="border-b hover:bg-pink-200 border-pink-100">
                    <td class="table-td text-center" colspan="6">No product inside the cart!</td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>

    <!-- loading indicator -->
    <div class="my-2 flex place-content-center">
        <img wire:target='sort' wire:loading.delay.short class="max-w-[10rem]"
            src="{{ asset('storage/default_images/snail_loading.png!bw700') }}" alt="Loading Indicator Image">
    </div>

    @push('layout-script-stack')
    <script>
        function updateOrderQuantity(id) {
            const quantity = document.querySelector(`#order-${id}-quantity`).value;
            Livewire.dispatch('update-order-quantity', {id:id, quantity: quantity})
        }
    </script>
    @endpush

</div>