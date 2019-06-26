<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLine extends ESLModel
{
    protected $fillable = ['purchase_order_id','description','qty','rate','in_quotation',
        'total_amount','tax_code','tax_description','tax_id','tax','stock_link'];

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
