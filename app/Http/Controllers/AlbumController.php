<?php

namespace App\Http\Controllers;

use App\Album;
use App\Article;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Resources\AlbumResource;
use App\Http\Resources\AlbumCollection;

class AlbumController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request){

        try{
            $album = Album::create([
                'article_id' => $request->get('article_id'),
                'project_id' => $request->get('project_id')
            ]);

            // return response();
            return response(new AlbumResource($album));
        } catch (Exception $e) {
            abort(400);
        }
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

    public function project(Project $project)
    {
        try{

            $albums = Album::where('project_id', $project->id)->get();
            return response(new AlbumCollection($albums));
        } catch (Exception $e) {
            return response(['message' => 'Something went wrong on our end.'])
                    ->setStatusCode($e->getStatusCode());
        }
    }
}
