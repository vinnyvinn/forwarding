<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class PettyCash extends ESLModel
{
    protected $fillable = ['quotation_id','employee_number', 'currency_type', 'vouchertype', 'user_id','amount','deadline','reason','file_path'];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
