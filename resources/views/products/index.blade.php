@foreach ($products as $product)
    <div>
        <p>{{ $product->name }}</p>
        <p>{{ $product->description }}</p>
        <p>{{ $product->price }}</p>
    </div>
@endforeach