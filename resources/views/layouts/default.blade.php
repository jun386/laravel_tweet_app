<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tweet-app</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/app.js" defer></script>
    <script src="https://kit.fontawesome.com/9c7a2b17b7.js" crossorigin="anonymous"></script>
</head>
<body class="bg-white">
    
    @yield('headernav')
    
    <div class="container mt-5">
        @yield('content')
    </div>
    
</body>
</html>