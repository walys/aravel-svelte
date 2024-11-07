<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Situation;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\SituationRepositories;

class SituationController extends Controller
{

    use HttpResponses;

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SituationRepositories $repository)
    {
        return $repository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SituationRepositories $repository)
    {
        $result = $repository->add($request);
        if($result['status'] != 200){
            return $this->error($result['message'], $result['status'], ['Error ao cadastrar a Situação']);
        }

        return $this->response($result['message'], $result['status'], $result['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(SituationRepositories $repository, int $id)
    {
        return $repository->getShow($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SituationRepositories $repository, string $id)
    {
        $result = $repository->up($request, $id);
        if($result['status'] != 200){
            return $this->error($result['message'], $result['status'], ['Error ao cadastrar a situação!']);
        }

        return $this->response($result['message'], $result['status'], $result['data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SituationRepositories $repository, int $id)
    {
        $result = $repository->delete($id);
        if($result['status'] != 200){
            return $this->error($result['message'], $result['status'], ['Error ao excluír a situação']);
        }

        return $this->response($result['message'], $result['status']);
    }
}
