<?php
// app/CommissionModel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionModel extends Model
{
    protected $table = 'commission_models';

    protected $fillable = ['model_type', 'price_data'];

    protected $casts = [
        'price_data' => 'array',
    ];
}
