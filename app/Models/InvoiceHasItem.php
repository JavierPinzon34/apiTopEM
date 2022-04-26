<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceHasItem extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_has_items';

    protected $fillable = [
        'invoice_id',
        'item_id',
        'quantity'
    ];

    protected $casts = [
        'invoice_id' => 'integer',
        'item_id' => 'integer',
        'quantity' => 'integer',
    ];

    public function hasItem()
    {
        return $this->belongsTo(\App\Models\Item::class,'item_id');
    }
}
