<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response(ArticleResource::collection(Article::all()));
        } catch(Exception $e) {
            return response(['message' => 'Something went wrong on our end.'])
                    ->setStatusCode($e->getStatusCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        try{
            // Create Article with properties filtered by StoreArticleRequest
            $article = Article::create($request->all());

            return response(new ArticleResource($article));
        } catch(Exception $e) {
            return response(['message' => 'Something went wrong on our end.'])
                    ->setStatusCode($e->getStatusCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        try{
            return response(new ArticleResource($article));
        } catch (Exception $e) {
            return response(['message' => 'Something went wrong on our end.'])
                    ->setStatusCode($e->getStatusCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        try{
            $article->fill($request->all())->save();
            
            return response(new ArticleResource($article));
        } catch (Exception $e) {
            return response(['message' => 'Something went wrong on our end.'])
                    ->setStatusCode($e->getStatusCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try{
            $article->delete();

            return response(['message' => 'Resource deleted.']);
        } catch (Exception $e) {
            return response(['message' => 'Something went wrong on our end.'])
                    ->setStatusCode($e->getStatusCode());
        }
    }
}
