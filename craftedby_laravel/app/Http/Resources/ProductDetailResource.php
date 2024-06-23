<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//         return parent::toArray($request);
        return [
            'id' =>$this->id,
            'name' => $this->name,
            'price' => $this->price,
            'weight' => $this->weight,
            'stock'=> $this->stock,
            'material'=>$this-> material,
            'history'=>$this->history,
            'image_path'=>$this->image_path,
            'description' => $this->description,

        ];
    }
}
