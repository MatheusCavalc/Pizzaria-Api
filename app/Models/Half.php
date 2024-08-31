<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Half extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'link_image',
        'on_sell',
        'description',
        'price',
        'quantity',
        'on_sale',
        'sale_price',
    ];

    public function setPriceAttribute($value)
    {
        $value = str_replace(',', '.', $value);

        if (!str_contains($value, '.')) {
            $value .= '.00';
        }

        $this->attributes['price'] = $value;
    }

    public function setSalePriceAttribute($value)
    {
        // Verifica se o valor é nulo
        if (is_null($value)) {
            $this->attributes['sale_price'] = null;
            return;
        }

        $value = str_replace(',', '.', $value);

        if (!str_contains($value, '.')) {
            $value .= '.00';
        }

        $this->attributes['sale_price'] = $value;
    }
}
