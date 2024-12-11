
<link rel="stylesheet" href="/css/login.css">
<title>Food Makers - Login</title>
<x-layout>
    <div class="login-form">
        <form action="/login" method="POST" class="login-form-inputs">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email-field" name="email" placeholder="Email">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password-field" placeholder="Senha">
            <button type="button" onclick="login(this)">Login</button>
        </form>
        <p class="dev-warning" style="background-color: gray; color: black;">Se você está testando este projeto, primeiro crie uma conta em <a href="/register">localhost:8000/register</a></p>
    </div>
    <script src="/js/login.js"></script>
</x-layout>
