<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    use ApiResponser;

    public function index(){
        if(Auth::user()->user_type =='Admin'){
            $loansData = Loan::all();
        }else{
            $loansData = Loan::where('customer_id',Auth::id())->get();
        }
        return $this->success(
            [
                'loans' => $loansData,
            ],
            'Loan data retrived successfully'
        );
    }

    public function store(Request $request){
        // dd($request->all());
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'loan_amount' => 'required|string',
            'no_of_terms' => 'required|numeric'
        ]);
   
        if($validator->fails()){
            return $this->error('Validation Error.', $validator->errors(),401);       
        }

        $loan_amount= $input['loan_amount'];
        $loan =new Loan();
        $loan->customer_id = Auth::id();
        $loan->loan_amount = $loan_amount;
        $loan->no_of_terms = $input['no_of_terms'];
        //$loan->minimum_per_term_amount = round($loan_amount/ $input['no_of_terms'],5);
        $loan->status = 'PENDING';
        $loan->paid_amount = 0;
        $loan->loan_date = date('Y-m-d');
        $loan->save();
        $nextRepayDate = Carbon::createFromFormat('Y-m-d', $loan->loan_date)->addDays(7);
          for ($i=1; $i <= $input['no_of_terms']; $i++) {
            $loanRepayment = new LoanRepayment;
            $loanRepayment->loan_id= $loan->id;
            $loanRepayment->repay_date= $nextRepayDate;
            if($i == $input['no_of_terms']){
                $amountCalculation= round($loan_amount/ $input['no_of_terms'],5) * ($i-1);
                $term_amount = round($loan->loan_amount - $amountCalculation,5);
                //dd($term_amount);
                $loanRepayment->term_amount= $term_amount;
            }else{
                // dd(round($loan_amount/ $input['no_of_terms'],5));
                 $loanRepayment->term_amount=  round($loan_amount/ $input['no_of_terms'],5);
            }
            $loanRepayment->paid_amount=  0;
            $loanRepayment->status= 'PENDING';
            $loanRepayment->save();
            $nextRepayDate=$loanRepayment->repay_date->addDays(7);
          }
        return $this->success([
            'loan' => $loan,
        ],'Loan created successfully..');

        

    }

    public function repayment(Request $request){
        // dd($request->all());
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'loan_id' => 'required|numeric|exists:loans,id',
            'amount' => 'required|numeric'
        ]);
        if($validator->fails()){
            return $this->error('Validation Error.', $validator->errors(),401);       
        }

        // $x = 10.000 / 3;
        // $decimal_part = $x - floor($x);
        // dd(round($x,5,0),$decimal_part);

        $loan =Loan::where('id',$input['loan_id'])
        ->where('status','APPROVED')->first();
        if($loan){
                $amount =$input['amount'];
            if($loan->paid_amount < $loan->loan_amount){
                if($amount >= $loan->minimum_per_term_amount){
                    $previousPaidAmount =  $loan->paid_amount;
                    $previousCurrentTerm =  $loan->current_term;
                    $paidAmount = round($previousPaidAmount + $amount,5);
                    if($paidAmount <= $loan->loan_amount){
                        $currentTerm = $previousCurrentTerm +1;
                        $loan->paid_amount = $paidAmount;
                        $loan->current_term = $currentTerm;
                        $loan->save();
                        if($loan->paid_amount >= $loan->loan_amount){
                             $loan->status='PAID';
                             $loan->save();
                        }
                        if($loan->loanRepayments){
                              $repayment=$loan->loanRepayments()->where('status','APPROVED')->first();
                              // dd($repayment);
                              if($repayment){
                                    $repayment->paid_amount = $amount;
                                    $repayment->actual_paid_date=date('Y-m-d H:i:s');
                                    $repayment->status='PAID';
                                    $repayment->save();
                              }else{
                                return $this->error('Validation Error.', 'Repayment schedule not found',200); 
                              }

                        }
                        /**  term amount exceeds minimum term amount Start **/
                        if($amount > $loan->minimum_per_term_amount){
                            $remaningTerm =$loan->no_of_terms - $loan->current_term; 
                            $remaningAmount =$loan->loan_amount - $loan->paid_amount; 
                            $minimumPerTermAmount = $remaningAmount/$remaningTerm;
                            $loan->minimum_per_term_amount =$minimumPerTermAmount;
                            $loan->save();
                            if($loan->loanRepayments){
                                   $repayments=$loan->loanRepayments()->where('status','APPROVED')->delete();
                            }
                            for ($i=1; $i <= $remaningTerm ; $i++) { 
                                $loanRepayment = new LoanRepayment;
                                $loanRepayment->loan_id= $loan->id;
                                $loanRepayment->repay_date= date('Y-m-d H:i:s');
                                $loanRepayment->term_amount=  $loan->minimum_per_term_amount;
                                $loanRepayment->paid_amount=  0;
                                $loanRepayment->status= 'APPROVED';
                                $loanRepayment->save();
                            }
                        }
                        /**  term amount exceeds minimum term amount End **/
                    }else{
                        $remaningAmount = $loan->loan_amount - $previousPaidAmount;
                         return $this->error('Validation Error.', 'Your term anount is only '. $remaningAmount ,200); 
                    }
                  }else{
                    return $this->error('Validation Error.', 'Paying amount should be greater than or equal to your term amount '.$loan->minimum_per_term_amount,200); 
                  }
           }else{
                    return $this->error('Validation Error.', 'Loan amount already fully paid',200); 
            }
             
        }else{
             $loan =Loan::with('loanRepayments')->where('id',$input['loan_id'])
            ->where('status','PAID')->first();
            if($loan){
                return $this->error('Validation Error.', 'Loan amount already fully paid',200); 
            }
            return $this->error('Validation Error.', 'Loan data not found',401);     
        }

         $loan =Loan::with('loanRepayments')->where('id',$input['loan_id'])
         ->where('status','APPROVED')->first();
            $message='Loan Repayment success';
        if(!$loan){
              $loan =Loan::with('loanRepayments')->where('id',$input['loan_id'])
            ->where('status','PAID')->first();
            $message='Loan fully paid thank you';
        }
        return $this->success([
            'loan' => $loan,
        ],$message);


    }


    
}
