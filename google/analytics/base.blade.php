<!DOCTYPE html>
<html lang="en">
<head>
    <title>Google Analytics</title>
    <meta charset="utf-8">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$tagId}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', {{$tagId}});
    </script>
</head>
<body>
@yield('body')
</body>
</html>
