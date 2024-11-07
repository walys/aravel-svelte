<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SituationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'color' => $this->color,
            'description' => $this->description,
            'created_at' => Carbon::parse($this->data_task)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::parse($this->data_task)->format('d/m/Y H:i:s'),
        ];
    }
}
