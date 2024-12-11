@auth
<link rel="stylesheet" href="/css/edit-product.css">
<title>Food Makers Admin - Edit</title>
<x-layout>
    <div class="product">
        <div class="image-list-container">
            <div class="image-list">
                <label type="file" class="image-card add-button" style="cursor: pointer;">
                    <form action="/upload-image" method="POST" enctype="multipart/form-data">
                        @csrf
                        <img class="image-card-image" src="/add.png" alt="">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input onchange="uploadImage(this)" id="add-image-button" type="file" accept="image/png, image/jpeg" name="content">
                    </form>
                </label>
                @foreach($images as $image)
                    <div class="image-card">
                        <form action="/delete-image" method="POST">
                            @csrf
                            @method('DELETE')
                            <label id="mylabel" onclick="this.parentElement.submit();" >
                                <img class="image-card-delete" src="/bin.png" alt="deletar" />
                                <input type="hidden" value="{{ $image->id }}" name="id" />
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            </label>

                        </form>
                        <img class="image-card-image" src="{{ $image->content }}" alt="" />
                    </div>
                @endforeach

            </div>
        </div>

        <div class="product-form">
            <form action="/edit-product/{{$product->id}}" method="POST"  class="product-form-inputs">
                @csrf
                @method('PUT')
                <label for="name">Nome *</label>
                <input type="text" value="{{$product->name}}" name="name" id="name-field" placeholder="Nome">
                <label for="price">Preço *</label>
                <input type="number" value="{{$product->price}}" name="price" id="price-field" placeholder="R$ 99,99">
                <label for="description">Descrição</label>
                <textarea name="description" id="description-field">{{$product->description}}</textarea>
                <label for="category_id">Categoria *</label>
                <select value="{{$product->category_id}}" name="category_id" id="category-field">
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
