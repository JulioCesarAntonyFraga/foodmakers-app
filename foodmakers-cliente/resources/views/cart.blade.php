@auth
<link rel="stylesheet" href="/css/cart.css">
<link rel="stylesheet" href="/css/cart-action-buttons.css">
<title>Foodmakers - Carrinho</title>
<x-layout>
    <div class="cart">
        <div class="cart-product-list">
            @foreach($cartProducts as $cartProduct)
            <div class="product-cart-card">
                <div class="product-cart-card-image">
                    <img class="product-card-image" src="{{ $images->where('product_id', $cartProduct->product_id)->first()['content']; }}" alt="">
                </div>
                <div class="product-cart-card-info">
                    <p id="product-cart-title">{{ $products->where('id', $cartProduct->product_id)->first()['name']; }}</p>
                    <p id="product-cart-price">R$ {{ number_format($products->where('id', $cartProduct->product_id)->first()['price'] * $cartProduct['quantity'], 2, ',', '.'); }}</p>
                    <p id="product-cart-description">{{ $products->where('id', $cartProduct->product_id)->first()['description']; }}</p>
                    <div class="product-cart-card-actions">
                        <form action="/delete/{{ $cartProduct ->product_id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="removeProduct(this)" class="product-cart-card-action-button cart-action-button" style="color: red;">-</button>
                        </form>
                        <span id="amount">{{ $cartProduct->quantity }}</span>
                        <form action="/add/{{ $cartProduct ->product_id }}" method="POST">
                            @csrf
                            <button class="product-cart-card-action-button cart-action-button" onclick="addProduct(this)" style="color: greenyellow;">+</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="order-form">
            <form action="/create-order/{{ $cart->id }}" method="POST" class="order-form-inputs">
                @csrf
                <label for="phone">Telefone *</label>
                <input type="text" id="phone-field" name="phone" placeholder="(99) 9999-9999">
                <label for="cupom">Cupom</label>
                <input type="text" name="cupon" id="cupon-field" placeholder="Cupom">
                <label for="address">Endereço *</label>
                <textarea name="address" name="address" id="address-field"></textarea>
                <label for="observations">Observações</label>
                <textarea name="observations" id="observation-field"></textarea>
                <label for="payment_method">Método De Pagamento *</label>
                <select name="payment_method" id="paymentMethod-field">
                    <option value="0">Pix</option>
                    <option value="1">Cartão de Crédito</option>
                </select>
                <span>R$ {{ number_format($cart->total_price, 2, ',', '.') }}</span>
                <button type="button" onclick="proceedCheckout(this)">Finalizar Pedido</button>
            </form>
        </div>
    </div>
    <script src="/js/AddToCart.js"></script>
    <script src="/js/Cart.js"></script>
</x-layout>
@else
<script>
    window.location.href = '/';
</script>
@endauth
