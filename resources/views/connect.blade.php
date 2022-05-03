@extends('template')

@section('content')

    <div class="header">
        <h1><img src="/assets/bookmark.svg">Micromarks</h1>
        <p>Manage your <a href="https://micro.blog">Micro.blog</a> bookmarks. Sign in with your domain below.</p>
    </div>
    @if (session()->get('errors') && isset(session()->get('errors')->all()[0]))
        <p class="errors">
            {{ session()->get('errors')->all()[0] }}
        </p>
    @endif
    <form action="/login" method="post" class="login">
        <input id="domain" type="url" name="url" value="" placeholder="https://username.micro.blog" class="login__input">
        <input type="submit" value="Log In" onclick="rememberDomain()">
        {{ csrf_field() }}
    </form>
    <div class="login__remember">
        <input id="remember" name="remember" type="checkbox"><label for="remember">Remember Domain</label>
    </div>

    <script>
        localStorageExists = () => {
            const test = 'lstest'
            try {
                localStorage.setItem(test, test);
                localStorage.removeItem(test);
                return true;
            } catch(e) {
                return false;
            }
        }

        const rememberCheck = document.getElementById('remember'),
            domainInput = document.getElementById('domain')

        if (localStorageExists())
        {
            if (localStorage.checkbox && localStorage.checkbox !== '') {
                rememberCheck.setAttribute('checked', 'checked')
                domainInput.value = localStorage.domain
            } else {
                rememberCheck.removeAttribute('checked')
                domainInput.value = ""
            }
        }

        function rememberDomain() {
            if (localStorageExists()) {
                if (rememberCheck.checked && domainInput.value !== '') {
                    localStorage.domain = domainInput.value
                    localStorage.checkbox = rememberCheck.value
                } else {
                    localStorage.domain = ''
                    localStorage.checkbox = ''
                }
            }
        }
    </script>

@stop
