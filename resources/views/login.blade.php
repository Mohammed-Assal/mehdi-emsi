<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Professeur Login</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f4f7fb; }
        .container { max-width: 400px; margin: 80px auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; margin-bottom: 1.5rem; color: #234F87; }
        input { width: 100%; padding: 0.75rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 0.75rem; background-color: #4A84C5; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        button:hover { background-color: #234F87; }
        .error { color: red; margin-bottom: 1rem; font-size: 0.9rem; }
        .success { color: green; margin-bottom: 1rem; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Professeur Login</h1>

        <div id="message"></div>

        <form id="loginForm">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        const form = document.getElementById('loginForm');
        const messageDiv = document.getElementById('message');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = form.email.value;
            const password = form.password.value;

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/api/professeurs/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if(response.ok) {


                window.location.href = '/';
                } else {
                    messageDiv.innerHTML = `<div class="error">${data.message || 'Login failed'}</div>`;
                }
            } catch (error) {
                messageDiv.innerHTML = `<div class="error">An error occurred</div>`;
            }
        });
    </script>
</body>
</html>
