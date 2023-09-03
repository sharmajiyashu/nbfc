<?php

namespace App\Helpers;

use App\Models\ApplicationForm;
use App\Models\Document;

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
            Document::$dl
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

}