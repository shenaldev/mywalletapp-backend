<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SinglePaymentResource extends JsonResource
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
            'name' => $this->name,
            'amount' => $this->amount,
            'date' => $this->date,
            'currency' => $this->currency,
            'category' => $this->category->name,
            'slug' => $this->category->slug,
            'payment_method' => $this->payment_method->name,
            'payment_note' => $this->payment_note?->note
        ];
    }
}
