<?php

namespace App\Http\Resources;
use App\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
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
        'edition' => $this->edition,
        'start_date' => $this->start_date,
        'end_date' => $this->end_date,
        'course' => Course::withTrashed()->find($this->course_id),
    ];
}
}
