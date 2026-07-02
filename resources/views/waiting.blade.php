<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="text-center mt-20">
        <h1 class="text-2xl font-bold text-yellow-500">Menunggu Persetujuan</h1>
        <p>Akun Anda sedang diproses oleh guru/admin</p>
        <form method="post" action="/logout">
                @csrf
                <button class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                    Logout
                </button>
            </form>
    </div>
</body>
</html>
