<?php

namespace App\Http\Controllers;

use App\Album;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreImageRequest;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request, Album $album)
    {

        // Process image
        try{

            if ($request->hasFile('file')) {

                // Get path from uploaded file
                $path = $request->file('file')->store('public/images/');

                // Create new Image
                $album->images()->create(
                    ['path' => $path]
                );

                return response(['error' => false, 'message' => 'Image saved']);
            }
        } catch (\Exception $e){
            return response(
                [
                    'error' => true,
                    'message' => $e->getMessage()
                ], 
                $e->getStatusCode()
            );    
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return response(new ImageResource($image));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        try{
            if(Storage::exists($image->path)){
                Storage::delete($image->path);
            }
            if ($image->delete()) {
                return response(['error' => false, 'message' => 'Image deleted']);
            }
            throw new FileNotFoundException;
        } catch(FileNotFoundException $e) {
            return abort(404);
        } catch(\Exception $e) {
            return abort(400);
        }
        
    }

}
