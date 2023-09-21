<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'student_number' => $this->student_number,
            'name' => $this->name,
            'image' => $this->image,
            'email' => $this->email,
            'classroom' => new ClassroomResource($this->classroom),
            'evaluation' => new EvaluationResource($this->evaluation),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
