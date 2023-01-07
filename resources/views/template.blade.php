<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/light.css" type="text/css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/assets/style.css" type="text/css" media="screen" title="no title" charset="utf-8">

    <title>Micromarks - Manage your Micro.blog Bookmarks</title>

    <script src="https://cdn.usefathom.com/script.js" data-site="VAYWMJXG" defer></script>

</head>
    <body>

        <div class="header">
            <h1><img src="/assets/bookmark.svg">Micromarks</h1>
            <p>Manage your <a href="https://micro.blog">Micro.blog</a> bookmarks.</p>
        </div>

        @if (session()->get('mb_user'))
            <div class="details">
                <div>
                    <img class="avatar" src="{{session()->get('mb_user')['photo']}}">
                </div>
                <div>
                    <p>Signed in as {{ session()->get('mb_user')['name'] }} <a href="/logout">Sign Out</a><br>
                    <a href="{{ session()->get('mb_user')['url'] }}">{{ session()->get('mb_user')['url'] }}</a></p>
                </div>
            </div>
        @endif

        @yield('content')

        <footer>
            <a href="https://github.com/rknightuk/micromarks" class="github-corner" aria-label="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
            <p>Made by <a href="http://rknight.me">Robb Knight</a> &bull; <a href="https://www.buymeacoffee.com/rknightuk">Buy me a Coffee</a> &bull; Softies icons by <a href="https://robbiepearce.com/softies/">Robbie Pearce</a></p>
        </footer>

        <svg width="0" height="0" class="hidden">
        <symbol version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" id="delete">
            <defs></defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Artboard-4" transform="translate(-224.000000, -159.000000)">
                <g id="25" transform="translate(224.000000, 159.000000)">
                <path d="M5,7 L5,20.0081158 C5,21.1082031 5.89706013,22 7.00585866,22 L16.9941413,22 C18.1019465,22 19,21.1066027 19,20.0081158 L19,7" id="Path-296" stroke="currentColor" stroke-width="2"></path>
                <rect id="Rectangle-424" fill="currentColor" x="2" y="4" width="20" height="2" rx="1"></rect>
                <path d="M9,10.9970301 C9,10.4463856 9.44386482,10 10,10 C10.5522847,10 11,10.4530363 11,10.9970301 L11,17.0029699 C11,17.5536144 10.5561352,18 10,18 C9.44771525,18 9,17.5469637 9,17.0029699 L9,10.9970301 Z M13,10.9970301 C13,10.4463856 13.4438648,10 14,10 C14.5522847,10 15,10.4530363 15,10.9970301 L15,17.0029699 C15,17.5536144 14.5561352,18 14,18 C13.4477153,18 13,17.5469637 13,17.0029699 L13,10.9970301 Z" id="Combined-Shape" fill="currentColor"></path>
                <path d="M9,5 L9,2.99895656 C9,2.44724809 9.45097518,2 9.99077797,2 L14.009222,2 C14.5564136,2 15,2.44266033 15,2.99895656 L15,5" id="Path-33" stroke="currentColor" stroke-width="2" stroke-linejoin="round"></path>
                </g>
            </g>
            </g>
        </symbol>
        </svg>

    </body>
</html>
