@auth
<link rel="stylesheet" href="/css/product-list.css">
<title>Food Makers - Produtos</title>
<x-layout>
        <div class="list-header">
            <div class="list-header-title-container">
                <h1 id="list-header-title">Produtos</h1>
                <p id="list-header-category-description">Lanches</p>
            </div>
            <div class="list-header-filters-container">
                <p>Categorias</p>
                <form action="{{ url('/product-list') }}" method="GET">
                    <select name="id" id="categories-select" onchange="this.form.submit()">
                        <option value="">Todas as Categorias</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <div class="product-list">
            @foreach($products as $product)
                @if($images->where('product_id', $product->id)->isNotEmpty())
                    <div class="product-card">
                        <a href="/product-details/{{ $product->id }}" class="product-card-body">
                            <img class="product-card-image" src="{{ $images->where('product_id', $product->id)->first()['content'];}}" alt="">
                            <p class="product-card-name">{{ $product->name }}</p>
                            <p class="product-card-price">R$ {{ $product->price }}</p>
                            <span class="product-card-description">{{ $product->description }}</span>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <script src="/js/AddToCart.js"></script>
    <script src="/js/filter.js"></script>
</x-layout>
@else
<script>
    window.location.href = '/';
</script>
@endauth
