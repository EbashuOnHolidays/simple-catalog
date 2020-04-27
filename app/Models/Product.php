<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App\Models
 * @property integer $id
 * @property string  $name
 * @property string  $desc
 * @property float   $price
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'price',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
