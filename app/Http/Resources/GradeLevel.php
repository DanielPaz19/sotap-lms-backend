<?php

namespace App\Http\Resources;


use App\Http\Resources\Subject as SubjectResource;
use App\Http\Resources\Student as StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeLevel extends JsonResource
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
            'level' => $this->level,
            'name' => $this->name,
            'subjects' => SubjectResource::collection($this->subject),
            'students' => StudentResource::collection($this->student),
        ];
    }
}
