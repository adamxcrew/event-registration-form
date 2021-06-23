<?php

namespace App\Traits;

use App\Models\Price;

/**
 * Priceable relationship trait
 */
trait HasPrice
{
    public function price()
    {
        return $this->morphOne(Price::class, 'priceable');
    }


    public function prices()
    {
        return $this->morphMany(Price::class, 'priceable');
    }

    public function setPrice($priceList)
    {
        foreach ($priceList ?? [] as $id => $values) {
            $this->prices()->updateOrCreate(
                ['category_id' => $id],
                $values,
            );
        }
    }
}
