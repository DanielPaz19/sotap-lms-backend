<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Subject extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'subject_code' => $this->subject_code,
            'subject_name' => $this->subject_name,
            'subject_description' => $this->subject_description,
            'img_url' => $this->img_url,
            'teachers' => $this->teachers,
        ];
    }
}
