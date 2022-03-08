<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChallengeResource extends JsonResource
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
            'challenger_id' => $this->challenger_id,
            'challenged_id' => $this->challenged_id,
            'week_id' => $this->week_id,
            'winner_id' => $this->winner_id,
            'challenged_at' => $this->challenged_at,
            'challenger_rank' => $this->challenger_rank,
            'challenged_rank' => $this->challenged_rank,
            'video' => $this->video
        ];
    }
}
