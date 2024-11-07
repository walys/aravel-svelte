<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\HttpResponses;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id ' => $this->id,
            'user_id ' => $this->user_id,
            'situation_id ' => $this->situation_id,
            'task_name' => $this->task_name,
            'description' => $this->description,
            'data_task' => Carbon::parse($this->data_task)->format('d/m/Y'),
            'situacao' => [
                'color' => $this->situation->color,
                'description' => $this->situation->description,
            ],
        ];
    }
}
