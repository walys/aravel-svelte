<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\V1\UserResource;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserRepositories
{
    public function get()
    {
        return UserResource::collection(User::all());
    }

    public function getShow(int $id)
    {
        return User::select('id', 'name', 'email','email_verified_at', 'password', 'remember_token', 'updated_at', 'created_at')->where('id', $id)->get();
    }

    public function add(Request $request, User $user)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => ['required', Rule::unique('users')->ignore($request->id)],
                'password' =>'required',
            ]);

            if($validator->fails()){
                throw new Exception($validator->errors(), 422);
            }

            $created = User::create($validator->validated());

            if($created){
                throw new Exception('Usuário cadastrado com sucesso!', 200);
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
                'name' => 'required',
                'email' => 'required',
                'password' =>'required',
            ]);

            if($validator->fails()){
                throw new Exception($validator->errors(), 422);
            }

            $validated = $validator->validated();
            $update = User::find($id);
            if(!$update){
                throw new Exception('Chave de indentificação não encontrda!', 400);
            }

            $update->update($validated);
            if($update){
                throw new Exception('Usuario alterado com sucesso!', 200);
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
            $user = User::find($id);
            if(!$user){
                throw new Exception('Chave de indentificação não encontrda!!', 400);
            }

            $deleted = $user->delete();
            if($deleted){
                throw new Exception('Usuário excluída com sucesso!', 200);
            }
        } catch (\Exception $e) {
            return array(
                'message' => $e->getMessage(),
                'status' => $e->getCode(),
            );
        }
    }
}
