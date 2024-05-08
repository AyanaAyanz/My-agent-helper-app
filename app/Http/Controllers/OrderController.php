<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payment;
use App\Models\Bank;
use App\Models\DateSettings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{
    //view orders
    public function view()
    {    
      
     $lastUpdatedDate = DateSettings::orderBy('updated_at', 'desc')->first();
     $date = $lastUpdatedDate->date ?? now()->toDateString();
     $orders = Orders::with('bankDetails')
    ->whereDate('ord_date', '=', $date)
    ->where('is_active', '=', 1)
    ->orderBy('created_at', 'desc')
    ->get();

     $sumAmount = $orders->sum('amount');
    
        
     return view("all_order", compact('orders','sumAmount'));

    }
    
   public function add()
{
    // Retrieve the first record from the DateSettings model
   $date_settings = DateSettings::orderBy('date', 'desc')->first();
  
    
    
    $bank = Bank::orderBy('bank_name')->get();
    
    return view("add_order", compact('bank', 'date_settings'));
}

    //add orders
    public function store(Request $request){
     
    // return $request;
        $data = $request->input('data');
        
        $acc_name = $request->input('acc_name');
        $name = $request->input('name');
        
        $ord_name = $acc_name ? $acc_name : $name;

        if (!$ind_id || $ind_id == 999) {
            $ind_id = 1;
        } else {
            $ind_id++;
        }
		
        $status = 1;
        $balance =0;
        $paid_amnt = 0;
       
        Orders::create([
            'ord_date' => $request->input('ord_date'),
            'mode' => $request->input('mode'),
            'name' => $ord_name,
            'mobile_1' => $request->input('mobile_1'),
            'mobile_2' => $request->input('mobile_2'),
            'address' => $request->input('address'),
            'bank' => $request->input('bank'),
            'acc_no' => $request->input('acc_no'),
            'ifsc' => $request->input('ifsc'),
            'amount' => $request->input('amount'),
            'status' => $status,
            'balance' => $request->input('amount'),
            'paid_amt' => $paid_amnt,
           'country' => $gccAgent->country,
           'cid'     => $gccAgent->cid,
        ]);
            
                    $todayDate = Carbon::now()->format('d-m-Y');
            
             $todayDateCheck = now()->toDateString();
             $orderDate = $request->input('ord_date');
              if ($orderDate == $todayDateCheck) {
                   $successMessage = 'Data added Successfully';
                    $redirectRoute = 'orders.view';
              } else {
                  
       
             $successMessage = 'Data added Successfully';
             $redirectRoute = 'pend_orders.view';
              }
             Session::flash('success_message', $successMessage);
             Session::flash('redirect_route', $redirectRoute);
              return redirect()->route('orders.add');

        
        
    }
    public function delete_order(Request $request, $id)
{
    //return $ord_id;
   $item = Orders::where('id', '=', $id);
   $item->delete();
}

 

    return redirect()->route('orders.view')->with('success', 'Item deleted successfully');
}


public function editOrder($id)
{ 
 
//return response()->json(['ord_id' => $ord_id]);
$orders = Orders::where('id', $id)->first();

// Check if the order with the given ord_id exists
if (!$orders) {
    return response()->json(['error' => 'Order not found'], 404);
}

$banks = $orders->bank;

$bank_name = Bank::where('id', '=',$banks)->select('bank_name')->get();

$bank = Bank::orderBy('bank_name')->get();

    return view('edit_order', ['orders' => $orders],compact('bank_name','bank'));
}

public function updateOrder(Request $request,$id){
    //return $request;
     $data = Orders::find($id);
$name = $request->input('name');
$bank_name = $request->input('bank_name');
$ord_name = !empty($name) ? $name : $bank_name;

   $data->ord_date = $request->input('ord_date');
   $data->mode = $request->input('mode');
   $data->name = $ord_name;
   $data->address = $request->input('address');
   $data->mobile_1 = $request->input('mobile_1');
   $data->mobile_2 = $request->input('mobile_2');
   $data->bank = $request->input('bank');
   $data->acc_no = $request->input('acc_no');
   $data->ifsc = $request->input('ifsc');
   $data->amount = $request->input('amount');
   $data->balance = $request->input('amount') - $data->paid_amt;
   
  if ($request->input('paid_amt') > 0) {
    $data->paid_amt = $request->input('paid_amt');
    $data->status = 2;
} else {
    $data->paid_amt = 0;
    $data->status = 1;
}

   $data->save();
    Session::flash('success_message', 'Data updated Successfully');
    return redirect()->route('orders.view');
   }

}
