<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MicroPubController extends Controller
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://micro.blog/',
        ]);
    }

    public function bookmarks()
    {
        $response = $this->client->request('GET', 'posts/bookmarks', [
            'headers' => $this->getHeaders(),
        ]);

        return json_decode($response->getBody()->getContents())->items;
    }

    public function createBookmark(Request $request)
    {
        $url = $request->input('url');
        $response = $this->client->request('POST', 'micropub?bookmark-of=' . $url . '&h=bookmark', [
            'headers' => $this->getHeaders(),
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function deleteBookmark($id)
    {
        $this->client->request('DELETE', 'posts/bookmarks/' . $id, [
            'headers' => $this->getHeaders(),
        ]);

        return \response('bookmark deleted', 204);
    }

    private function getHeaders()
    {
        $token = \session()->get('mb_token');
        return [ 'Authorization' => 'Bearer ' . $token, 'Accept' => 'application/json', ];
    }
}
