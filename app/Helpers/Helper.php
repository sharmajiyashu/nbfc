<?php

namespace App\Helpers;

use App\Models\ApplicationForm;
use App\Models\Document;
use App\Models\Enquiry;
use App\Models\LedgerAccount;
use App\Models\LoanApplication;
use GuzzleHttp\Promise\Create;
use Illuminate\Pagination\LengthAwarePaginator;

class Helper
{
    
    public static function getCustomerkycDetail($customer_id){
        $documentTypes = [
            Document::$aadhar,
            Document::$pan,
            Document::$voter_id,
            Document::$other,
            Document::$property_type,
            Document::$bank_statement,
            Document::$ration_card,
            Document::$dl,
            Document::$cibil_score,
            Document::$cheque,
        ]; 
        
        $result = [];
        
        foreach ($documentTypes as $type) {
            $document = Document::where('customer_id', $customer_id)
                ->where('type', $type)
                ->whereNull('enquiry_id')
                ->first();
        
            $result[$type] = [
                'number' => optional($document)->desc ?? '',
                'image' => optional($document)->image ?? '',
            ];
        }

        // print_r($result);die;
        
        return $result;
    }

    public static function generateApplicationId(){
        $store_code = 'APP'.mt_rand(10000000, 99999999);
        if(ApplicationForm::where('application_id',$store_code)->first()){
            Helper::generateApplicationId();
        }else{
            return $store_code;
        }
    }

    public static function generateTransaction(){
        $store_code = 'TRN'.mt_rand(10000000, 99999999);
        if(ApplicationForm::where('application_id',$store_code)->first()){
            Helper::generateApplicationId();
        }else{
            return $store_code;
        }
    }

    public static function getEnquiryDocument($enquiry_id){
        
        $documentTypes = [
            Document::$aadhar,
            Document::$pan,
            Document::$voter_id,
            Document::$other,
        ];
        
        $result = [];
        
        foreach ($documentTypes as $type) {
            $document = Document::where('enquiry_id', $enquiry_id)
                ->where('type', $type)
                ->whereNull('customer_id')
                ->first();
        
            $result[$type] = [
                'number' => optional($document)->desc ?? '',
                'image' => optional($document)->image ?? '',
            ];
        }
        
        return $result;
    }

    public static function uploadDocument($image){

        $allowedImageTypes = ['jpeg', 'jpg','png', 'gif','JPG','PNG','JPEG']; // List of allowed image extensions

        
        if ($image !== null) {
            // Validate the file type
            $extension = $image->getClientOriginalExtension(); // Get the file extension

            if (in_array(strtolower($extension), $allowedImageTypes)) {
                // Valid image type
                $image_name = time().rand(1, 100).'-'.$image->getClientOriginalName();
                $image_name = preg_replace('/\s+/', '', $image_name);
                $destinationPath = public_path('images/documents');
    
                // Move the uploaded file to the destination path
                $image->move($destinationPath, $image_name);
    
                return $image_name;
            } else {
                // Invalid file type
                return '';
            }
        } else {
            // Handle the case where no file was uploaded
            return '';
        }
    }

    public static function getLoneName($loan_type){
        $loan = [
            '1' => 'Gold Loan',
            '2' => 'Group Loan',
            '3' => 'Personal Loan',
            '4' => 'Property Loan',
            '5' => 'Vehicle Loan'
        ];
        return isset($loan[$loan_type]) ? $loan[$loan_type] :'';
    }

    public static function usePagination($data,$page){
        $perPage = 10;
        $data = new LengthAwarePaginator(
            $data->forPage($page, $perPage),
            $data->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return $responseData = [
            'current_page' => $data->currentPage(),
            'data' => $data->values(),
            'first_page_url' => $data->url(1),
            'last_page' => $data->lastPage(),
            'last_page_url' => $data->url($data->lastPage()),
            'links' => [
                'prev_page_url' => $data->previousPageUrl(),
                'next_page_url' => $data->nextPageUrl(),
            ],
            'per_page' => $data->perPage(),
            'total' => $data->total(),
        ];
    }

    public static function PMT($interest, $period, $loan_amount, $additionalChargers)
  {
    $interest = (float) $interest;
    $period = (float) $period;

    if ($additionalChargers != null || $additionalChargers != "") {
      $loan_amountt = (float) $loan_amount;
      $loan_amount = $loan_amountt + $additionalChargers;

      $period = $period;
      $interest = $interest / 1200;
      $amount = $interest * -$loan_amount * pow((1 + $interest), $period) / (1 - pow((1 + $interest), $period));
      $rounded = round($amount);

      if ($rounded % 10 < 5) {
        $modified = floor($rounded / 10) * 10;
        return $modified;
      } else {

        $modified = ceil($rounded / 10) * 10;
        return $modified;
      }


    } else {

      $loan_amountt = (float) $loan_amount;
      // $loan_amount=$loan_amountt +$additionalChargers;
      $period = $period;
      $interest = $interest / 1200;
      $amount = $interest * -$loan_amount * pow((1 + $interest), $period) / (1 - pow((1 + $interest), $period));
      $rounded = round($amount);

      if ($rounded % 10 < 5) {
        $modified = floor($rounded / 10) * 10;
        return $modified;
      } else {

        $modified = ceil($rounded / 10) * 10;
        return $modified;
      }
    }
  }

  public static function showCalculation($balance, $interest_rate, $payment_date, $tenure, $emi)
  { 
    $data = [];
    for ($i = 1; $i <= $tenure; $i++) {
        $interest = 0;
        if (is_numeric($interest_rate) && is_numeric($balance)) {
            $interest = (($interest_rate / 100) * $balance) / 12;

        }
        // $interest = (is_numeric($interest_rate / 100 ) * is_numeric($balance))/12;
        $principal = $emi - $interest;
        $balance = $balance - $principal;
        if ($i != 1) {
            $payment_date = date('Y-m-d', strtotime("+1 month", strtotime($payment_date)));
        }
        $principal2 = round($principal, 2);
        $interest2 = round($interest, 2);
        $data[] = ['payement_date' => $payment_date, 'interest' => round($interest2), 'principal' => round($principal2), 'emi' => round($emi)];
        $this_month_date = date('Y-m');
        $emi_month_date = date('Y-m', strtotime($payment_date));
    }
    return $data;
  }


  public static function getInterestAndPrinciple($principal,$rate_of_interest,$tenure){
    $principal = $principal;  // Replace with your loan amount
    $annual_interest_rate = $rate_of_interest;  // Replace with your annual interest rate
    $loan_tenure_years = $tenure;  // Replace with your loan tenure in years

    // Convert annual interest rate to monthly interest rate
    $monthly_interest_rate = ($annual_interest_rate / 12) / 100;

    // Convert loan tenure to months
    $loan_tenure_months = $loan_tenure_years ;

    // Calculate EMI using the formula
    $emi = ($principal * $monthly_interest_rate * pow(1 + $monthly_interest_rate, $loan_tenure_months)) / (pow(1 + $monthly_interest_rate, $loan_tenure_months) - 1);

    // Calculate total interest paid
    $total_interest_paid = $emi * $loan_tenure_months - $principal;

    // Calculate total amount paid
    $total_amount_paid = $emi * $loan_tenure_months;


    return ['loan_amount' => round($principal) , 'rate_of_interest' => $annual_interest_rate ,  'tenure' => $loan_tenure_years ,'emi' => round($emi) 
    , 'total_interest_amount' => round($total_interest_paid) , 'total_amount_paid' => round($total_amount_paid)];
  }

  public static function generateLoanId($id){
    $loan = [
        '1' => 'G0L',
        '2' => 'GRL',
        '3' => 'PEL',
        '4' => 'PRL',
        '5' => 'VL'
    ];
    $store_code = $loan[$id].mt_rand(10000000, 99999999);
    if(LoanApplication::where('loan_id',$store_code)->first()){
        Helper::generateLoanId($id);
    }else{
        return $store_code;
    }

  }


  public static function setDefaultGeneralAccount(){
        LedgerAccount::updateOrCreate(['id' => 1],['name' => 'Cash', 'id' => 1]);
        LedgerAccount::updateOrCreate(['id' => 2],['name' => 'EMI Interest', 'id' => 2]);
        LedgerAccount::updateOrCreate(['id' => 3],['name' => 'Login Charge', 'id' => 3 ]);
        LedgerAccount::updateOrCreate(['id' => 4],['name' => 'Processing Fees' ,'id' => 4]);
        LedgerAccount::updateOrCreate(['id' => 5],['name' => 'Profit And Loss ' , 'id' => 5]);
        LedgerAccount::updateOrCreate(['id' => 6],['name' => 'Additional Charge' , 'status' => 1, 'id' => 6]);
        LedgerAccount::updateOrCreate(['id' => 7],['name' => 'Penalty Amount' , 'status' => 1, 'id' => 7]);
        LedgerAccount::updateOrCreate(['id' => 8],['name' => '--' , 'status' => 0, 'id' => 8]);
        LedgerAccount::updateOrCreate(['id' => 9],['name' => '--' , 'status' => 0, 'id' => 9]);
        LedgerAccount::updateOrCreate(['id' => 10],['name' => '--' , 'status' => 0, 'id' => 10]);
        LedgerAccount::updateOrCreate(['id' => 11],['name' => '--' , 'status' => 0, 'id' => 11]);
        LedgerAccount::updateOrCreate(['id' => 12],['name' => '--' , 'status' => 0, 'id' => 12]);
        LedgerAccount::updateOrCreate(['id' => 13],['name' => '--' , 'status' => 0, 'id' => 13]);
        LedgerAccount::updateOrCreate(['id' => 14],['name' => '--' , 'status' => 0, 'id' => 14]);
        LedgerAccount::updateOrCreate(['id' => 15],['name' => '--' , 'status' => 0, 'id' => 15]);
        LedgerAccount::updateOrCreate(['id' => 16],['name' => '--' , 'status' => 0, 'id' => 16]);
        LedgerAccount::updateOrCreate(['id' => 17],['name' => '--' , 'status' => 0, 'id' => 17]);
        LedgerAccount::updateOrCreate(['id' => 18],['name' => '--' , 'status' => 0, 'id' => 18]);
        LedgerAccount::updateOrCreate(['id' => 19],['name' => '--' , 'status' => 0, 'id' => 19]);
        LedgerAccount::updateOrCreate(['id' => 20],['name' => '--' , 'status' => 0, 'id' => 20]);
  }

  public static function getEnquirybyLoanId($loan_id){
    $loan = LoanApplication::find($loan_id);
    $application = ApplicationForm::find($loan->application_id);
    return $application->enquiry_id;
  }

}