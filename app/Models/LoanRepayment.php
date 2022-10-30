<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class LoanRepayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'term_amount',
        'paid_amount',
    ];

    public function loan(){
        return $this->belongsTo("App\Models\Loan",'loan_id');
    }
}
