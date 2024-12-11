@auth
<link rel="stylesheet" href="/css/product-details.css">
<link rel="stylesheet" href="/css/carousel.css">
<title>Foodmakers - Produto</title>
<x-layout>
    <div class="product-details-card">
        <div class="product-details-card-image">
            <div class="slideshow-container">
                @foreach($images as $image)
                    <div class="mySlides fade">
                        <img src="{{ $image->content }}" style="width:100%">
                    </div>
                @endforeach

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
        <div class="product-details-card-info">
            <p id="product-details-title">{{ $product->name }}</p>
            <p id="product-details-price">R$ {{ $product->price }}</p>
            <p id="product-details-description">{{ $product->description }}</p>
            <div class="product-details-card-actions">
                <form action="/add/{{ $product->id }}" method="POST">
                    @csrf
                    <button type="submit" class="product-details-card-action-button">Adicionar ao carrinho</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/js/AddToCart.js"></script>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
         showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
    </script>
</x-layout>
@else
<script>
    window.location.href = '/';
</script>
@endauth
