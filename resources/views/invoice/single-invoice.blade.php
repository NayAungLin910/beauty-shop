<div style="border-radius: 0.5rem; background-color: white; padding: 0.5rem; margin: 0.5rem;">
    
    <hr>

    <div style="padding: 0.5rem">
        <h2 style="font-size: 1.125rem; line-height: 1.75rem; margin-left: 0.25rem; margin-right: 0.25rem;">Orders</h2>

        <!-- Invoices Table -->
        <div
            style="overflow: auto; border-radius: 0.5rem; margin: 0.5rem; margin-top: 0.75rem; margin-bottom: 0.75rem;">
            <table
                style="width: 100%; border-collapse: collapse; border-width: 1px; background-color: lightpink; border-color: lightpink;">
                <thead
                    style="border-bottom-width: 1px; font-size: 1.125rem; line-height: 1.75rem; border-color: lightpink;">
                    <tr>
                        <th style="text-align: end;">Product Name</th>
                        <th style="text-align: end;">Price</th>
                        <th style="text-align: end;">Quantity</th>
                        <th style="text-align: end;">Created At</th>
                        <th style="text-align: end;">Subtotal Price</th>
                    </tr>
                </thead>
                <tbody style="border-bottom-width: 1px; border-color: lightpink;">
                    @if ($invoice->orders && $invoice->orders->count())
                    @foreach ($invoice->orders as $order)
                    <tr style="border-bottom-width: 1px; border-color: lightpink;">
                        <td>
                            {{ $order->product->name }}
                        </td>
                        <td>
                            {{ $order->product->price }}
                        </td>
                        <td>
                            {{ $order->quantity }}
                        </td>
                        <td>
                            {{ $order->created_at }}
                        </td>
                        <td>
                            {{ $order->sub_price }}
                        </td>
                    </tr>
                    @endforeach
                    <!-- Total Price -->
                    <tr style="border-bottom-width: 1px; border-color: lightpink;">
                        <td colspan="3"></td>
                        <td>
                            Total Price
                        </td>
                        <td>
                            {{ $invoice->total_price }}
                        </td>
                    </tr>
                    @else
                    <tr style="border-bottom-width: 1px; border-color: lightpink;">
                        <td style="text-align: center;" colspan="6">No product inside the cart!</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>