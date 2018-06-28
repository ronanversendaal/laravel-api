<?php namespace App\Http\Controllers;

use App\Project;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response(ProjectResource::collection(Project::all()));
        } catch(Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        try{
            // Create project with properties filtered by StoreProjectRequest
            $project = Project::create($request->all());

            return response(new ProjectResource($project));
        } catch(Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        try{
            return response(new ProjectResource($project));
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try{
            $project->fill($request->all())->save();
            
            return response(new ProjectResource($project));
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try{
            $project->delete();

            return response(['message' => 'Resource deleted.']);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
