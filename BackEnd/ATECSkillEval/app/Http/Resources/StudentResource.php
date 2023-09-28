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
            'birth_date' => $this->birth_date,
            'classroom' => new ClassroomResource($this->classroom),
        ];
    }
}
