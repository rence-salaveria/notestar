<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Note */
class NoteResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'noteTitle' => $this->title,
            'noteBody' => $this->content,
            'meta' => [
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'owner' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];
    }
}
