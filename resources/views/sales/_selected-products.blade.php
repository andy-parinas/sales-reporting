<div class="my-10 px-5 w-288 mx-auto">
    <table class="w-full">
        <thead>
            <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                <th class="py-2 px-2 border border-gray-800">Selected Product</th>
                <th class="py-2 px-2 border border-gray-800">Type</th>
                <th class="py-2 px-2 border border-gray-800 text-right">Price</th>
                <th class="py-2 px-2 border border-gray-800 text-right">QTY</th>
                <th class="py-2 px-2 border border-gray-800 text-right">Total</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($selectedProducts as $selectedProduct)
                    <tr class="text-sm">
                        <td class="py-2 px-4 border border-gray-800">{{ $selectedProduct->product->name }}</td>
                        <td class="py-2 px-4 border border-gray-800 "> {{ $selectedProduct->product->productType->name }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right">{{ number_format($selectedProduct->product->price, 2, '.', ',') }}</td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ $selectedProduct->quantity }}</td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ $selectedProduct->total }} </td>
                    </tr>
                @endforeach

            <tr class="text-sm bg-yellow-300">
                <td class="py-2 px-4 border border-gray-800">Sub Total</td>
                <td class="py-2 px-4 border border-gray-800"> </td>
                <td class="py-2 px-4 border border-gray-800"> </td>
                <td class="py-2 px-4 border border-gray-800 text-right"></td>
                <td class="py-2 px-4 border border-gray-800 text-right"> {{ $sale->total_sales }}</td>
            </tr>
        </tbody>
    </table>
</div>