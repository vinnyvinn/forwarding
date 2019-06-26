<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class TransportService extends ESLModel
{
    protected $fillable = ['type','StockLink','name','rate','unit'];
}
