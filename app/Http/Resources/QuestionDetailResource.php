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
            'answers_count' => $this->answers()->count(),
            'has_answers' => $this->hasAnswer,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'variants' => $this->variants->map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->text,
                ];
            }),
        ];
    }
}
