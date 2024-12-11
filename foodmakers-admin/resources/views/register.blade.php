
<link rel="stylesheet" href="/css/login.css">
<title>Food Makers - Register Dev</title>
<x-layout>
    <div class="login-form">
        <form action="/create" method="POST" class="login-form-inputs">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name-field" placeholder="Nome">
            <label for="email">Email</label>
            <input type="email" name="email" id="email-field" placeholder="Email">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password-field" placeholder="Senha">
            <button type="button" onclick="login(this)">Register</button>
            @csrf
        </form>
    </div>
    <script src="/js/login.js"></script>
</x-layout>
