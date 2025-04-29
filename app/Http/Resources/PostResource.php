<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'title' => $this->title,
        'content' => $this->content,
        'category_id' => $this->category_id,
        'user_id' => $this->user_id,
        'created_at' => $this->created_at->format('Y-m-d H:i:s'),

        'images' => $this->images->map(function ($image) {
            return asset('storage/' . $image->image_path);
        }),
        'likes_count' => $this->likes->count(),

        'comments' => $this->comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'content' => $comment->content,
                'user' => [
                    'id' => $comment->user->id ?? null,
                    'name' => $comment->user->name ?? 'Unknown',
                ],
                'created_at' => $comment->created_at->diffForHumans(),
            ];
        }),
    ];
}

}
