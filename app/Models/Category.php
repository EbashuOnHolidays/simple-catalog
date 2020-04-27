<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Models
 * @property integer    $id
 * @property string     $name
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 * @property Collection $products
 */
class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
