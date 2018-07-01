<?php

namespace App\Http\Controllers;

use App\Album;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Resources\AlbumResource;
use App\Http\Resources\AlbumCollection;

class AlbumController extends Controller
{
    public function index()
    {

    }
    
    public function show(Album $album)
    {
        try{
            return response(new AlbumResource($album));
        } catch (Exception $e) {
            return response(['message' => 'Something went wrong on our end.'])
                    ->setStatusCode($e->getStatusCode());
        }
    }

    public function article(Article $article)
    {
        try{

            $albums = Album::where('article_id', $article->id)->get();
            return response(new AlbumCollection($albums));
        } catch (Exception $e) {
            return response(['message' => 'Something went wrong on our end.'])
                    ->setStatusCode($e->getStatusCode());
        }
    }
}
