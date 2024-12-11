@auth
<link rel="stylesheet" href="/css/create-product.css">
<title>Food Makers Admin - Edit</title>
<x-layout>
        <div class="product-form">
            <form action="/create-product" method="POST" class="product-form-inputs">
                @csrf
                <label for="name">Nome *</label>
                <input type="text" name="name" id="name-field" placeholder="Nome">
                <label for="price">Preço *</label>
                <input type="number" name="price" id="price-field" placeholder="R$ 99,99">
                <label for="description">Descrição</label>
                <textarea name="description" id="description-field"></textarea>
                <label for="category_id">Categoria *</label>
                <select name="category_id" id="category-field">
                    <option value="1">Lanche</option>
                    <option value="2">Bebida</option>
                </select>
                <div class="form-actions">
                    <button type="button" class="save-button" onclick="formIsValid(this) ? this.form.submit() : null">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="/js/edit-product.js"></script>
</x-layout>
@else
    <script>
        window.location.href = '/';
    </script>
@endauth
