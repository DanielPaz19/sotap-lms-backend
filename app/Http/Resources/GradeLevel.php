<?php

namespace App\Http\Resources;


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
            'subject_teachers' => SubjectTeacher::collection($this->subject_teachers),
            'students' => $this->students,
        ];
    }
}
