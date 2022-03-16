<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResultResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'created_at' => Carbon::create($this->created_at)->toIso8601ZuluString(),
            'variants' => $this->variants->map(function($variant) {
                return [
                    'id' => $variant->id,
                    'text' => $variant->text,
                    'users' => $variant->answers->map(function($answer) {
                        return [
                            'id' => $answer->user->id,
                            'name' => $answer->user->name,
                        ];
                    }),
                ];
            }),
        ];
    }
}
