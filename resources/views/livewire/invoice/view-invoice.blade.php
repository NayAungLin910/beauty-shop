<div class="">

    <!-- Header --->
    <h1 class="text-2xl text-center my-2">Your Invoices</h1>

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


    @if ($invoices && $invoices->count())
    @foreach ($invoices as $invoice)
    <div class="rounded-lg bg-white p-2 m-2" id="invoice-{{ $loop->index + 1 }}">
        <div class="my-2 mx-1 text-normal">
            <!-- Description -->
            <div class="my-2 md:w-1/3">
                <span class="font-bold">
                    Description
                </span>
                <br />
                <p class="my-2">
                    {{ $invoice->description }}
                </p>
            </div>
            <hr class="">
            <!-- Destination -->
            <div class="my-2 md:w-1/3">
                <span class="font-bold">
                    Destination
                </span>
                <br />
                <p class="my-2">
                    {{ $invoice->destination }}
                </p>
            </div>
        </div>

        <hr>

        <div class="p-2">
            <h2 class="text-lg mx-2">Orders</h2>

            <!-- Invoices Table -->
            <div wire:loading.delay.short.remove wire:target="sort" class="overflow-auto rounded-lg shadow-md m-2 my-3">
                <table class="w-full border-collapse border bg-pink-100 border-pink-100">
                    <thead class="border-b text-lg border-pink-100">
                        <tr>
                            <th class="table-th">Product Name</th>
                            <th class="table-th">Price</th>
                            <th class="table-th">Quantity</th>
                            <th class="table-th">Created At</th>
                            <th class="table-th">Subtotal Price</th>
                        </tr>
                    </thead>
                    <tbody class="border-b border-pink-100">
                        @if ($invoice->orders && $invoice->orders->count())
                        @foreach ($invoice->orders as $order)
                        <tr class="border-b hover:bg-pink-200 border-pink-100">
                            <td class="table-td">
                                {{ $order->product->name }}
                            </td>
                            <td class="table-td">
                                {{ $order->product->price }}
                            </td>
                            <td class="table-td flex items-center w-[9rem]">
                                <span class="block">{{ $order->quantity }}</span>
                            </td>
                            <td class="table-td">
                                {{ $order->created_at }}
                            </td>
                            <td class="table-td">
                                {{ $order->sub_price }}
                            </td>
                        </tr>
                        @endforeach
                        <!-- Total Price -->
                        <tr class="border-b hover:bg-pink-200 border-pink-100">
                            <td class="table-td">
                                <!-- Download -->
                                <a href="{{ route('invoices.download', ['id' => $invoice->id]) }}"
                                    class="button-pink-rounded p-1 cursor-pointer  px-[0.35rem] text-xl m-0">
                                    <ion-icon name="download-outline" wire:ignore></ion-icon>
                                </a>
                            </td>
                            <td class="table-td" colspan="2"></td>
                            <td class="table-td text-end">
                                Total Price
                            </td>
                            <td class="table-td">
                                <div class="flex items-center place-content-between gap-2">
                                    <span>
                                        {{ $invoice->total_price }}
                                    </span>
                                </div>
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
        </div>
    </div>
    @endforeach
    @else
    <h2 class="text-center text-lg">No invoices yet!</h2>
    @endif

    @if ($invoices && $invoices->count())
    <!-- Pagination -->
    <div wire:loading.delay.short.remove class="m-2">
        {{ $invoices->links() }}
    </div>
    @endif

    <!-- loading indicator -->
    <div class="my-2 flex place-content-center">
        <img wire:loading.delay.short class="max-w-[10rem]"
            src="{{ asset('storage/default_images/snail_loading.png!bw700') }}" alt="Loading Indicator Image">
    </div>
</div>