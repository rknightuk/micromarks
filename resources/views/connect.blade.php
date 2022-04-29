@extends('template')

@section('content')

    <div class="header">
        <h1><img src="/assets/bookmark.svg">Micromarks</h1>
        <p>Manage your <a href="https://micro.blog">Micro.blog</a> bookmarks. Sign in with your domain below.</p>
    </div>
    <form action="/login" method="post" class="login">
        <input type="url" name="url" value="" placeholder="https://username.micro.blog" class="login__input">
        <input type="submit" value="Log In">
        {{ csrf_field() }}
    </form>

@stop
