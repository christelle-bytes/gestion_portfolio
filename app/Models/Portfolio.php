<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{

    
    protected $fillable = [ 'title','description', 'languages', 'user_id' ];

      protected $casts = [
        'languages' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function portfolioImage(): HasMany{
        return $this->hasMany(PortfolioImage::class);
    }
   
}
