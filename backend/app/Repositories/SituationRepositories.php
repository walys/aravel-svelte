<?php

namespace App\Repositories;

use App\Models\Situation;
use Illuminate\Http\Request;
use App\Http\Resources\V1\SituationResource;
use Illuminate\Support\Facades\Validator;
use Exception;

class SituationRepositories
{
    public function get()
    {
        return SituationResource::collection(Situation::get());
    }

    public function getShow(int $id)
    {
        return Situation::select('id', 'color', 'description', 'updated_at', 'created_at')->where('id', $id)->get();
    }

    public function add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'color' => 'required',
                'description' =>'required',
            ]);

            if($validator->fails()){
                throw new Exception($validator->errors(), 422);
            }

            $created = Situation::create($validator->validated());

            if($created){
                throw new Exception('Situação criada com sucesso!', 200);
            }

          }catch (\Exception $e) {

            return array(
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
                'data' => $validator->getData()
            );
          }
    }

    public function up(Request $request, int $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'color' => 'required',
                'description' => 'required',
            ]);

            if($validator->fails()){
                throw new Exception($validator->errors(), 422);
            }

            $validated = $validator->validated();
            $update = Situation::find($id);
            if(!$update){
                throw new Exception('Chave de indentificação não encontrda!', 400);
            }

            $update->update($validated);
            if($update){
                throw new Exception('Situação alterada com sucesso!', 200);
            }

        } catch (\Exception $e) {
            return array(
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
                'data' => $validator->getData()
            );
        }
    }

    public function delete(int $id)
    {
        try {
            $task = Situation::find($id);
            if(!$task){
                throw new Exception('Chave de indentificação não encontrda!!', 400);
            }

            $deleted = $task->delete();
            if($deleted){
                throw new Exception('Situação excluída com sucesso!', 200);
            }
        } catch (\Exception $e) {
            return array(
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            );
        }
    }
}
