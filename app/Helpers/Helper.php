<?php

namespace App\Helpers;

use App\Models\ApplicationForm;
use App\Models\Document;
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

}