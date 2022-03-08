<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'has_answer' => $this->has_answer,
            'answers_count' => $this->answers()->count(),
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'variants' => $this->variants->map(function($variant) {
                return [
                    'id' => $variant->id,
                    'text' => $variant->text,
                ];
            }),
        ];
    }
}
