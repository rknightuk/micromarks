<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IndieAuth\Client;
use Throwable;

class IndieAuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (\session()->get('mb_token'))
        {
            return view('bookmarks');
        }
        return view('connect');
    }

    public function login(Request $request)
    {
        \session()->remove('mb_token');
        \session()->remove('mb_user');
        session_start();
        $appUrl = env('APP_URL');
        Client::$clientID = $appUrl . '/';
        Client::$redirectURL = $appUrl . '/redirect';

        $url = $request->input('url');
        if (!$url)
        {
            return redirect()->back()->withErrors('Domain is required');
        }

        try {
            [$authorizationURL, $error] = Client::begin($url, 'create');
        } catch (Throwable $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }

        if ($error) {
            return redirect()->back()->withErrors($error);
        } else {
            // Redirect the user to their authorization endpoint
            header('Location: '.$authorizationURL);
        }
    }

    public function redirect(Request $request)
    {
        \session_start();
        Client::$clientID = 'http://micromarks.test/';
        Client::$redirectURL = 'http://micromarks.test/redirect';

        [$response, $error] = Client::complete([
            'code' => $request->input('code'),
            'state' => $request->input('state'),
        ]);

        if ($error)
        {
            return redirect()->back()->withErrors($error);
        } else {
            \session()->put('mb_token', $response['response']['access_token']);
            \session()->put('mb_user', $response['response']['profile']);
            return redirect('/');
        }
    }

    public function logout()
    {
        \session()->flush();
        return redirect('/');
    }
}
