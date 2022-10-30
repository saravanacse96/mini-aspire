<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LoanRepayment;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'loan_amount',
        'no_of_terms',
    ];

    public function loanRepayments(){
        return $this->hasMany("App\Models\LoanRepayment", "loan_id", "id");
    }
}
