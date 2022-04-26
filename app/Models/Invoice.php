<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'number',
        'value',
        'total_value',
        'receiver_id',
        'transmitter_id',
        'iva',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function items()
    {
        return $this->belongsToMany(\App\Models\Item::class, 'invoice_has_items', 'invoice_id', 'item_id')->withPivot('quantity');
    }

    public function receiver()
    {
        return $this->belongsTo(\App\Models\Receiver::class);
    }

    public function transmitter()
    {
        return $this->belongsTo(\App\Models\Transmitter::class);
    }
}
