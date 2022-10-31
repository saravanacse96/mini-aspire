<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Loan;
use App\ModelsLoanRepayment;
use Auth;

class AdminController extends Controller
{
    use ApiResponser;

    public function approve(Request $request){
        
        $input = $request->all();

        $validator = Validator::make($input, [
            'loan_id' => 'required|numeric|exists:loans,id',
            'status' => 'required|string'
        ]);
   
        if($validator->fails()){
            return $this->error('Validation Error.', $validator->errors(),401);       
        }
      
        $loan =Loan::find($input['loan_id']);
        if($loan){
             $loan->status = 'APPROVED';
             $loan->approved_by = Auth::id();
             $loan->save();
             if($loan->loanRepayments){
                 foreach ( $loan->loanRepayments as $key => $repayments) {
                     $repayments->status='APPROVED';
                     $repayments->save();
                 }
            }
        }else{
            return $this->error('Validation Error.', 'Loan data not found',401);     
        }
        return $this->success([
            'loan' => $loan,
        ],'Loan Approved successfully..');

    }
}
