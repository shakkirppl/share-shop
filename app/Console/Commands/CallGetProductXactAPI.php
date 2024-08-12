<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExternalExactProduct;
use App\Models\Store;
use App\Models\Product;
use App\Models\Tax;
use App\Models\Category;
use App\Models\Unit;
use App\Models\ProductDetail;
use App\Models\SubCategory;
use App\Models\Brand;
class CallGetProductXactAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = 'vO1AqMXlvbg34THOnA5/6PZiSrIRbigu';
        $password = 'VRxGX8tfC1Ikiinj2ZTKysYs1fPJxWgnsE0xm06ulaE=';
        // API call
        $response = Http::timeout(600)->withBasicAuth($username, $password)->get('http://dipaiko.fortiddns.com:8023/data/getProducts', [
            'upTime' => ''
        ]);


  if ($response->successful()) {
             $data = $response->json();

            if ($data['Valid']) {
              $store_code=$data['ClientCode'];
                // foreach ($data['Records'] as $record) {
                //     $this->processRecord($record,$store_code);
                // }
                $this->processRecordtoProduct();
                $this->info('Customers processed successfully.');
            } else {
                $this->error('Invalid data received: ' . $data['Message']);
            }
        } else {
            $this->error('Failed to fetch customers.');
        }

        return Command::SUCCESS;
    }
    // public function handle()
    // {
    //     // $username = 'TCZIvABnFzNjpSW3W7eGAQ==';
    //     // $password = 'u20CBeUbsZB0Hl+lU8BGd1hjBEPhrnAjBSaq3eEqF6I=';
        
    //     $username = 'vO1AqMXlvbg34THOnA5/6PZiSrIRbigu';
    //     $password = 'VRxGX8tfC1Ikiinj2ZTKysYs1fPJxWgnsE0xm06ulaE=';
    //     // API call
    //             // First API URL to get products
    //             $apiUrlToCall = 'http://dipaiko.fortiddns.com:8023/data/getProducts';

    //             // Make the first API call with basic auth and timeout
    //             $response = Http::timeout(600)
    //                 ->withBasicAuth($username, $password)
    //                 ->get($apiUrlToCall, [
    //                     'upTime' => ''
    //                 ]);
    //                 print_r($response);
    //             // Check if the first API call was successful
    //             if ($response->failed()) {
    //                 return response()->json(['error' => 'Failed to fetch data from the first API.'], 500);
    //             }
        
    //             // Get the response body
    //             // $responseData = $response->body();
        
    //             // Second (whitelisted) API URL
    //             // $whiteListedApiUrl = 'http://68.183.92.8:3696/';
        
    //             // Make the second API call with basic auth
    //             // $response2 = Http::withBasicAuth($username, $password)
    //             //     ->post($whiteListedApiUrl, [
    //             //         'json' => $responseData
    //             //     ]);
        
    //             // Check if the second API call was successful
    //             // if ($response2->failed()) {
    //             //     return response()->json(['error' => 'Failed to post data to the second API.'], 500);
    //             // }
    //     // $response = Http::timeout(600)->withBasicAuth($username, $password)->get('http://dipaiko.fortiddns.com:8023/van_sales/data/getProducts', [
    //     //     'upTime' => ''
    //     // ]);
      
    //     exit;
    //     if ($response->successful()) {
    //         $data = $response->json();

    //        if ($data['Valid']) {
    //          $store_code=$data['CompanyCode'];
    //            foreach ($data['Records'] as $record) {
    //                $this->processRecord($record,$store_code);
                   
    //            }
    //           //  $this->processRecordtoProduct();
    //            $this->info('Product processed successfully.');
    //        } else {
    //            $this->error('Invalid data received: ' . $data['Message']);
    //        }
    //    } else {
    //        $this->error('Failed to fetch Product.');
    //    }
    //     return Command::SUCCESS;
    // }
//     public function handle()
// {
  
//     $username = 'vO1AqMXlvbg34THOnA5/6PZiSrIRbigu';
//     $password = 'VRxGX8tfC1Ikiinj2ZTKysYs1fPJxWgnsE0xm06ulaE=';
    
//     // First API URL to get products
//     $apiUrlToCall = 'http://dipaiko.fortiddns.com:8023/van_sales/data/getProducts';

//     // Make the first API call with basic auth and timeout
//     $response = Http::timeout(600)
//         ->withBasicAuth($username, $password)
//         ->get($apiUrlToCall, [
//             'upTime' => ''
//         ]);

//     // Check if the first API call was successful
//     if ($response->failed()) {
//         $this->error('Failed to fetch data from the first API.');
//         return Command::FAILURE;
//     }

//     // Get the response body
//     $responseData = $response->body();

//     // Second (whitelisted) API URL
//     $whiteListedApiUrl = 'http://68.183.92.8:3696/';

//     // Make the second API call with basic auth
//     $response2 = Http::withBasicAuth($username, $password)
//         ->post($whiteListedApiUrl, [
//             'json' => $responseData
//         ]);

//     // Check if the second API call was successful
//     if ($response2->failed()) {
//         $this->error('Failed to post data to the second API.');
//         return Command::FAILURE;
//     }

//     if ($response2->successful()) {
//         $data = $response2->json();

//         if ($data['Valid']) {
//             $store_code = $data['CompanyCode'];
//             foreach ($data['Records'] as $record) {
//                 $this->processRecord($record, $store_code);
//             }
//             $this->info('Product processed successfully.');
//             return Command::SUCCESS;
//         } else {
//             $this->error('Invalid data received: ' . $data['Message']);
//             return Command::FAILURE;
//         }
//     } else {
//         $this->error('Failed to fetch Product.');
//         return Command::FAILURE;
//     }
// }
    private function processRecord($record,$store_code)
    {
        $master=new ExternalExactProduct;
        $master->store_code=$store_code;
        $master->ProductId = $record['ProductId'];
        $master->ProductUnitId = $record['ProductUnitId'];
        $master->ProductCode = $record['ProductCode'];
        $master->ProductName = $record['ProductName'];
        $master->ProductNameArabic = $record['ProductNameArabic'];
        $master->UOM = $record['UOM'];
        $master->ConvertValue = $record['ConvertValue'];
        $master->Barcode = $record['Barcode'];
        $master->IsInternal = $record['IsInternal'];
        $master->IsActive = $record['IsActive'];
        $master->Packing = $record['Packing'];
        $master->IsBaseUom = $record['IsBaseUom'];
        $master->InvTypeId = $record['InvTypeId'];
        $master->InvType = $record['InvType'];
        $master->Department = $record['Department'];
        $master->Group = $record['Group'];
        $master->Category = $record['Category'];
        $master->Brand = $record['Brand'];
        $master->BranchCode = $record['BranchCode'];
        $master->Branch = $record['Branch'];
        $master->TaxPercent = $record['TaxPercent'];
        $master->SalePrice = $record['SalePrice'];
        $master->SaleTaxPrice = $record['SaleTaxPrice'];
        $master->NetSalePrice = $record['NetSalePrice'];
        $master->ProductUpTime = $record['ProductUpTime'];
        $master->ProductUnitUpTime = $record['ProductUnitUpTime'];
        $master->BarcodeUpTime = $record['BarcodeUpTime'];
        $master->ProductBranchUpTime = $record['ProductBranchUpTime'];
        $master->save();

                
        
    }
    private function processRecordtoProduct()
    {
      $external_product=ExternalExactProduct::UnSynchData()->get();
      foreach($external_product as $master){
          
            $store=Store::where('code',$master->store_code)->first();
    if($store)
    {
   
   
 //   tax
       $tax_id=0;
       $tax_percentage=0;
       $tax_percentage=Tax::where('percentage',$master->TaxPercent)->where('store_id',$store->id)->first();
       if($tax_percentage){
         $tax_id=$tax_percentage->id;
         $tax_percentage=$tax_percentage->percentage;
           
       }else{
          
         $tax_new=new Tax;
         $tax_new->name='VAT';
         $tax_new->percentage=$master->TaxPercent;
         $tax_new->store_id=$store->id;
         $tax_new->save();
         
       $tax_id=$tax_new->id;
       $tax_percentage=$master->TaxPercent;

          
       }
       
     // category
     $category=Category::where('name',$master->Group)->where('store_id',$store->id)->first();
     if($category)
     {$category_id=$category->id;}else{

       $category_new=new Category;
       $category_new->name=$master->Group;
       $category_new->store_id=$store->id;
       $category_new->save();
       $category_id=$category_new->id;
     }
     
  
      
        $subCategory=SubCategory::where('name',$master->Category)->first();
        if($subCategory)
        {$subCategory_id=$subCategory->id;}else{
          $sub_category_new=new SubCategory;
          $sub_category_new->name=$master->Category;
          $sub_category_new->category_id=$category_id;
          $sub_category_new->description=null;
          $sub_category_new->store_id=$store->id;
          $sub_category_new->save();
          $subCategory_id=$sub_category_new->id;}

        $brand=Brand::where('name',$master->Brand)->first();
        if($brand)
        {$brand_id=$brand->id;}else{
          $brand_new=new Brand;
          $brand_new->name=$master->Brand;
          $brand_new->store_id=$store->id;
          $brand_new->save();
          $brand_id=$brand_new->id;}
       
     //   unit
      $unit=Unit::where('name',$master->UOM)->where('store_id',$store->id)->first();
       if($unit)
     {$base_unit_id=$unit->id;}else{
       $unit_new=new Unit;
       $unit_new->name=$master->UOM;
       $unit_new->store_id=$store->id;
       $unit_new->save();
       $base_unit_id=$unit_new->id;
     }
     
 
      
if($master->ProductName){$name=$master->ProductName;}else{$name='';}
      $product=new Product; 
      $product->code=$master->ProductCode;
      $product->name=$name;
      $product->pro_image='default.jpg';
      $product->category_id=$category_id;
      $product->sub_category_id=$subCategory_id;
      $product->brand_id=$brand_id;
      $product->supplier_id=0;
      $product->tax_id=$tax_id;
      $product->tax_percentage=$tax_percentage;
      $product->price=$master->SalePrice;
      $product->base_unit_id=$base_unit_id;
      $product->base_unit_qty=$master->ConvertValue;
      $product->base_unit_discount=0;
      $product->base_unit_barcode=$master->Barcode;
      $product->base_unit_op_stock=0;
      $product->second_unit_price=0;
      $product->second_unit_id=0;
      $product->second_unit_qty=0;
      $product->second_unit_discount=0;
      $product->second_unit_barcode='';
      $product->second_unit_op_stock=0;
      $product->is_multiple_unit=1;
      $product->description=$master->Department;
      $product->store_id=$store->id;
      $product->save();
      $ex_data=ExternalExactProduct::find($master->id);
      $ex_data->sync_data=1;
      $ex_data->save();
    
if($unit){
     $productDetail=new ProductDetail;
     $productDetail->barcode=$product->base_unit_barcode;
     $productDetail->product_id=$product->id;
     $productDetail->unit=$product->base_unit_id;
     $productDetail->qty=1;
     $productDetail->discount=$product->base_unit_discount;
     $productDetail->op_stock=0;
     $productDetail->price=$product->price;
     $productDetail->store_id=$product->store_id;
     $productDetail->save();
}
 
    
    }
  }
    }
}
