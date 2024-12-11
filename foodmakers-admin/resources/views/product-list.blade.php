
@auth
<link rel="stylesheet" href="/css/product-list.css">
<title>Food Makers Admin - Lista De Produtos</title>
<x-layout>
    <div class="product-list-header">
        <button onclick="window.location.href = '/create-product'">Novo Produto</button>
    </div>
    <div class="product-list">
        @foreach($products as $product)
        <div class="product-card">
            <div class="product-card-info">
                <p id="product-title">{{ $product->name }}</p>
                <p id="product-price">R$ {{ $product->price }}</p>
            </div>
            <div class="product-card-actions">
                <button class="product-card-action-button" onclick="window.location.href = '/edit-product/{{ $product->id }}'"><img src="/edit.png" alt="edit"></button>
                <form action="/remove-product/{{$product->id}}" method="POST">@csrf @method('DELETE')<button type="button" class="product-card-action-button"onclick="window.confirm('Você tem certeza que deseja remover este produto?') ? this.form.submit() : null"><img src="/bin.png"  alt="remove"></button></form>
            </div>
        </div>
        @endforeach
    </div>
</x-layout>
@else
    <script>
        window.location.href = '/';
    </script>
@endauth
