<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExternalExactCustomer;
use App\Models\Store;
use App\Models\Customer;
use App\Models\InvoiceNumber;
use App\Models\Province;
class CallGetCustomersXactAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get-customers';

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
        $response = Http::timeout(600)->withBasicAuth($username, $password)->get('http://dipaiko.fortiddns.com:8023/data/getCustomers', [
            'upTime' => ''
        ]);


  if ($response->successful()) {
             $data = $response->json();

            if ($data['Valid']) {
              $store_code=$data['ClientCode'];
                // foreach ($data['Records'] as $record) {
                //     $this->processRecord($record,$store_code);
                // }
                $this->processRecordtoCustomer();
                $this->info('Customers processed successfully.');
            } else {
                $this->error('Invalid data received: ' . $data['Message']);
            }
        } else {
            $this->error('Failed to fetch customers.');
        }

        return Command::SUCCESS;
    }
//     public function handle()
//     {
//         $username = 'vO1AqMXlvbg34THOnA5/6PZiSrIRbigu';
//         $password = 'VRxGX8tfC1Ikiinj2ZTKysYs1fPJxWgnsE0xm06ulaE=';
//         // $username = 'TCZIvABnFzNjpSW3W7eGAQ==';
//         // $password = 'u20CBeUbsZB0Hl+lU8BGd1hjBEPhrnAjBSaq3eEqF6I=';
//         // API call
//         $response = Http::timeout(600)->withBasicAuth($username, $password)->get('http://dipaiko.fortiddns.com:8023/data/getCustomers', [
//             'upTime' => ''
//         ]);


//   if ($response->successful()) {
//              $data = $response->json();

//             if ($data['Valid']) {
//               $store_code=$data['CompanyCode'];
//                 foreach ($data['Records'] as $record) {
//                     $this->processRecord($record,$store_code);
//                 }
//                 $this->processRecordtoCustomer();
//                 $this->info('Customers processed successfully.');
//             } else {
//                 $this->error('Invalid data received: ' . $data['Message']);
//             }
//         } else {
//             $this->error('Failed to fetch customers.');
//         }

//         return Command::SUCCESS;
//     }
    private function processRecord($record,$store_code)
    {
        // Process each customer record
        // For simplicity, assuming you have a Customer model and corresponding table

$master=new ExternalExactCustomer;
$master->store_code=$store_code;
$master->CustomerId=$record['CustomerId'];
$master->CustomerCode=$record['CustomerCode'];
$master->CustomerName=$record['CustomerName'];
$master->LegalName=$record['LegalName'];
$master->ContactPerson=$record['ContactPerson'];
$master->ContactNo=$record['ContactNo'];
$master->EmailId=$record['EmailId'];
$master->Address01=$record['Address01'];
$master->Address02=$record['Address02'];
$master->Address03=$record['Address03'];
$master->EmirateName=$record['EmirateName'];
$master->TaxType=$record['TaxType'];
$master->RcmMode=$record['RcmMode'];
$master->VatRegistrationNo=$record['VatRegistrationNo'];
$master->CreditLimit=$record['CreditLimit'];
$master->CreditDays=$record['CreditDays'];
$master->IsActive=$record['IsActive'];
$master->UpTime=$record['UpTime'];
$master->save();



    }
    private function processRecordtoCustomer()
    {
        $external_customer=ExternalExactCustomer::UnSynchData()->get();
        foreach($external_customer as $master){
        $store=Store::where('code',$master->store_code)->first();
        if($store)
        {
        $province=Province::where('name',$master->EmirateName)->first();
        if($province)
        {
            $province_id=$province->id;
        }else{$province_id=0;}
        $existing_customer=Customer::where('erp_customer_code',$master->CustomerId)->first();
        if($existing_customer)
        {
        $customer= Customer::find($existing_customer->id);
        $customer->name=$master->CustomerName;
        $customer->trn=$master->VatRegistrationNo;
        $customer->cust_image='defalut.jpg';
        $customer->address=$master->Address01.$master->Address02.$master->Address03;
        $customer->contact_number=$master->ContactNo;
        $customer->whatsapp_number=$master->ContactNo;
        $customer->email=$master->EmailId;
     //   $customer->payment_terms=$master->bill_type;
        $customer->credit_limit=floatval($master->CreditLimit);
        $customer->credit_days=floatval($master->CreditDays);
        $customer->province_id=$province_id;
        $customer->store_id=$store->id;
        $customer->erp_customer_code=$master->CustomerId;
        $customer->save();
        $ex_data=ExternalExactCustomer::find($master->id);
        $ex_data->sync_data=1;
        $ex_data->save();
      
        }
        else{
        $invoice_no =  InvoiceNumber::ReturnInvoice('customer_code_generation',$store->id);
        $customer=new Customer;
        $customer->name=$master->CustomerName;
        $customer->code=$invoice_no;
        $customer->trn=$master->VatRegistrationNo;
        $customer->cust_image='defalut.jpg';
        $customer->address=$master->Address01.$master->Address02.$master->Address03;
        $customer->contact_number=$master->ContactNo;
        $customer->whatsapp_number=$master->ContactNo;
        $customer->email=$master->EmailId;
     //   $customer->payment_terms=$master->bill_type;
        $customer->credit_limit=floatval($master->CreditLimit);
        $customer->credit_days=floatval($master->CreditDays);
        $customer->province_id=$province_id;
        $customer->store_id=$store->id;
        $customer->erp_customer_code=$master->CustomerId;
        $customer->save();
        $ex_data=ExternalExactCustomer::find($master->id);
        $ex_data->sync_data=1;
        $ex_data->save();
        InvoiceNumber::updateinvoiceNumber('customer_code_generation',$store->id);
        }
        }
    }
    }
}
