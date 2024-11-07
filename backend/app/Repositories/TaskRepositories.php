<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\V1\TaskResource;
use App\Models\Situation;
use Illuminate\Support\Facades\Validator;
use Exception;

class TaskRepositories
{

    public function get()
    {
        return TaskResource::collection(task::with('situation')->get());
    }

    public function getShow(int $id)
    {
        return new TaskResource(task::where('id', $id)->first());
    }

    public function add(Request $request)
    {
        try {
            $data_tak = $request["data_tak"] ? $request["data_tak"] : date('Y/m/d H:i:s');
            $request["data_tak"] = $data_tak;
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'situation_id' =>'required',
                'task_name' =>'required|string',
                'description' =>'required|string',
                'data_tak' => $data_tak ?  'required|date_format:Y/m/d H:i:s' : 'nullable',
            ]);

            if($validator->fails()){
                throw new Exception($validator->errors(), 422);
            }

            $created = Task::create($validator->validated());

            if($created){
                throw new Exception('Tarefa criada com sucesso!', 200);
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
            $data_tak = $request["data_tak"] ? $request["data_tak"] : date('Y/m/d H:i:s');
            $request["data_tak"] = $data_tak;
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'situation_id' => 'required',
                'task_name' => 'required|string',
                'description' =>'required|string',
                'data_tak' => $data_tak ?  'required|date_format:Y/m/d H:i:s' : 'nullable',
            ]);

            if($validator->fails()){
                throw new Exception($validator->errors(), 422);
            }

            $validated = $validator->validated();
            $update = Task::find($id);
            if(!$update){
                throw new Exception('Chave de indentificação não encontrda!', 400);
            }

            $update->update($validated);
            if($update){
                throw new Exception('Tarefa alterada com sucesso!', 200);
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
            $task = Task::find($id);
            if(!$task){
                throw new Exception('Chave de indentificação não encontrda!!', 400);
            }

            $deleted = $task->delete();
            if($deleted){
                throw new Exception('Tarefa excluída com sucesso!', 200);
            }
        } catch (\Exception $e) {
            return array(
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            );
        }
    }
}
