<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getAmount(): int
    {
        return $this->getAttribute('amount');
    }

    public function getAmountFormatted(): float
    {
        return number_format($this->getAmount()/100, 2);
    }
}
