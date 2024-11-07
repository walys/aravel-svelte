<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepositories;

class TaskController extends Controller
{
    use HttpResponses;

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(TaskRepositories $repository)
    {
        return $repository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TaskRepositories $repository)
    {
        $result = $repository->add($request);
        if($result['status'] != 200){
            return $this->error($result['message'], $result['status'], ['Error ao cadastrar a Tarefa']);
        }

        return $this->response($result['message'], $result['status'], $result['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskRepositories $repository, int $id)
    {
        return $repository->getShow($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskRepositories $repository, int $id)
    {
        $result = $repository->up($request, $id);
        if($result['status'] != 200){
            return $this->error($result['message'], $result['status'], ['Error ao cadastrar a Tarefa']);
        }

        return $this->response($result['message'], $result['status'], $result['data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskRepositories $repository, int $id)
    {
        $result = $repository->delete($id);
        if($result['status'] != 200){
            return $this->error($result['message'], $result['status'], ['Error ao excluír a Tarefa']);
        }

        return $this->response($result['message'], $result['status']);
    }
}
