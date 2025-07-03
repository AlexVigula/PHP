<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    private $currency;

    public function __construct($resource, $currency = 'RUB')
    {
        parent::__construct($resource);
        $this->currency = $currency;
    }

    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'price' => $this->formatPrice($this->price),
        ];
    }

    private function formatPrice($priceInKopecks)
    {
        $rates = [
            'USD' => 90 * 100,  // 90 рублей = 1 USD (в копейках)
            'EUR' => 100 * 100, // 100 рублей = 1 EUR (в копейках)
            'RUB' => 1,         // Базовый курс
        ];

        $rate = $rates[$this->currency] ?? 1;
        $converted = $priceInKopecks / $rate;

        return match($this->currency) {
            'USD' => '$' . number_format($converted, 2, '.', ''),
            'EUR' => '€' . number_format($converted, 2, '.', ''),
            'RUB' => number_format($converted, 0, '', ' ') . ' ₽',
            default => number_format($converted, 2, '.', ''),
        };
    }
}
