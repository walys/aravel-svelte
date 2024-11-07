<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositories;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(UserRepositories $repository)
    {
        return $repository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UserRepositories $repository, User $user)
    {
        $result = $repository->add($request, $user);
        if($result['status'] != 200){
            return $this->error($result['message'], 422, ['Error ao cadastrar o usuário!']);
        }

        return $this->response($result['message'], $result['status'], $result['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRepositories $repository, int $id)
    {
        return $repository->getShow($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRepositories $repository, int $id)
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
    public function destroy(UserRepositories $repository, int $id)
    {
        $result = $repository->delete($id);
        if($result['status'] != 200){
            return $this->error($result['message'], $result['status'], ['Error ao excluír a Tarefa']);
        }

        return $this->response($result['message'], $result['status']);
    }
}
