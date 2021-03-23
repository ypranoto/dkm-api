<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\Handler;
use App\Models\Order\Order;
use App\Models\Order\Driver;
use DB;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('role',['except' => ['show']]);
    }

   //Order
    public function index()
    {
      $getData = DB::table('list_orders_pickingup')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.$val->no_order,
                    'client' => $val->name,
                    'delivery_fee' => $val->delivery_fee,
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'driver_name' => $val->driver_name,
                    'payment_method' => $val->method,
                    'payment_method_id' => $val->payment_method_id
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }
        return response()->json(['data' => $data]);
    }

    public function finishPickupList()
    {
        $getData = DB::table('list_orders_pickedup')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $date = date_create($val->order_date); 
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.intval($val->no_order),
                    'client' => $val->name,
                    'date' => date_format($date,'d-M-y') ,
                    'delivery_fee' => intval($val->delivery_fee),
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'payment_method' => $val->method,
                    'sender_address' => $val->sender_address,
                    'sender_phone' => $val->sender_phone,
                    'receiver_name' => $val->receiver_name,
                    'receiver_phone' => $val->receiver_phone,
                    'receiver_address' => $val->receiver_address,
                    'price' => intval($val->price),
                    'total' => $val->price + $val->delivery_fee,
                    'driver_name' => $val->driver_name
                   
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }
        return response()->json(['data' => $data]);
    }

    public function readyToDeliveryList()
    {
        $getData = DB::table('list_orders_ready_to_deliver')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.$val->no_order,
                    'client' => $val->name,
                    'delivery_fee' => $val->delivery_fee,
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'payment_method' => $val->method,
                    'method_id' => $val->method_id,
                    'driver_name' => $val->driver_name,
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }

        return response()->json(['data' => $data]);
    }

    public function deliveredList()
    {
        $getData = DB::table('list_orders_delivered')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.$val->no_order,
                    'client' => $val->name,
                    'delivery_fee' => $val->delivery_fee,
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'payment_method' => $val->method,
                    'pickup_driver' => $val->pickup_driver,
                    'deliver_driver' => $val->deliver_driver
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }

        return response()->json(['data' => $data]);
    }
    public function deliveredHistoryList()
    {
        $getData = DB::table('list_orders_delivered_history')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.$val->no_order,
                    'client' => $val->name,
                    'delivery_fee' => $val->delivery_fee,
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'payment_method' => $val->method,
                    'pickup_driver' => $val->pickup_driver,
                    'deliver_driver' => $val->deliver_driver
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }

        return response()->json(['data' => $data]);
    }

    public function reDeliveryList()
    {
        $getData = DB::table('list_orders_redelivery')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.$val->no_order,
                    'client' => $val->name,
                    'delivery_fee' => $val->delivery_fee,
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'payment_method' => $val->method,
                    'deliver_driver' => $val->deliver_driver,
                    'redeliver_driver' => $val->redeliver_driver
                    
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }

        return response()->json(['data' => $data]);
    }

    public function canceledList()
    {
        $getData = DB::table('list_orders_cancel')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.$val->no_order,
                    'client' => $val->name,
                    'delivery_fee' => $val->delivery_fee,
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'payment_method' => $val->method
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }

        return response()->json(['data' => $data]);
    }

    public function canceledHistoryList()
    {
        $getData = DB::table('list_orders_cancel_history')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.$val->no_order,
                    'client' => $val->name,
                    'delivery_fee' => $val->delivery_fee,
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'payment_method' => $val->method
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }

        return response()->json(['data' => $data]);
    }

    public function returnList()
    {
        $getData = DB::table('list_orders_return')->get();
        $data = [];
        if(!empty($getData)){
            foreach($getData as $val){
                $arr = array(
                    'id' => $val->id,
                    'no_order' => '#'.$val->no_order,
                    'client' => $val->name,
                    'delivery_fee' => $val->delivery_fee,
                    'order_status' => $val->order_status,
                    'payment_status' => $val->payment_status,
                    'payment_method' => $val->method,
                    'pickup_driver' => $val->pickup_driver,
                    'deliver_driver' => $val->deliver_driver
                );
                array_push($data,$arr);
            }
        }else{
            return response()->json('Belum ada order', 404);
        }

        return response()->json(['data' => $data]);
    }

    public function createOrder(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'weight' => 'required',
            'volume' =>'required',
            'price' => 'required'
            // 'photo' => 'required|image',
        ]);
        if($request->input('user_id') == null){
            $id = auth()->user()->id;  
        }else{
            $id = $request->input('user_id');
        }
        $numb = rand(0,999999);
        $date = str_shuffle(date('dY'));
        $code = substr($numb + $date, 0, 6);
        $district = $request->input('district');
        $price = $request->input('price');

        //insert photo
        if ($request->hasFile('photo')) 
        { 
            $fileExtension = $request->file('photo')->getClientOriginalName(); 
            $file = pathinfo($fileExtension, PATHINFO_FILENAME); 
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileStore = $file . '_' . time() . '.' . $extension; 
            $img = 'photo/product/'. base64_encode($fileStore);
            $path = $request->file('photo')->storeAs('photo/product',$fileStore); 
        } else{
            $img = 'photo/product/bm8tdGh1bWJuYWlsXzE2MTQwNTIwNjMuanBn';
        }

        //Create Payment
        $payment_id = DB::table('payments')->insertGetId([
            'user_id' => $id,
            'status' => 1,
            'price' => $price,
            'payment_method_id' => $request->input('payment_method')
        ]);

        //Create Delivery Address
        $deliv_address = DB::table('delivery_addresses')->insertGetId([
            'address' =>   $request->input('receiver_address'),
            'description' =>  $request->input('description_address'),
            'district' =>  $request->input('district'),
            'village' =>  $request->input('village'),
            'latitude' => $request->input('latitude'),
            'longitude' =>  $request->input('longitude')
        ]);

        $w = $request->input('weight');
        $delivery_fee = $request->input('delivery_fee');
        //Check Customer
        $checkCust = DB::table('pre-pickup-assigned-check')->where('user_id',$id)->get();
        //Assign Pickup Driver
        if(count($checkCust) == 0 && $request->input('village') === "null"){
                    $getDriver = DB::select('
                    SELECT
                    user_id, 
                    coalesce(count, 0) as count
                    FROM
                        drivers
                        LEFT JOIN
                        count_driver_order
                        ON 
                            drivers.user_id = count_driver_order.id
                    WHERE
                        drivers.district_placement = '.$district.' 
                        AND
                        coalesce(count, 0) < 25
                    ORDER BY
                        count ASC
                    LIMIT 1
                    ')[0]->user_id;
                    
        }
        elseif(count($checkCust) == 0 && $request->input('village') !== "null"){
            $getDriver = DB::select('
                                SELECT
                                user_id, 
                                coalesce(count, 0) as count
                                FROM
                                    drivers
                                    LEFT JOIN
                                    count_driver_order
                                    ON 
                                        drivers.user_id = count_driver_order.id
                                WHERE
                                    drivers.district_placement = '.$district.' 
                                    AND
                                drivers.village_placement LIKE "%'.$request->input('village').'%"
                                    AND
                                    coalesce(count, 0) < 25
                                ORDER BY
                                    count ASC
                                LIMIT 1')[0]->user_id;
        }
        else
        {
            $getDriver = $checkCust[0]->driver_id_pickup;
        }

        $driver =  $getDriver;

        $order = new Order;
        $order->user_id = $id ;
        $order->no_order = $code;
        $order->order_statuses_id = 1 ;
        $order->driver_id_pickup = $driver;
        $order->delivery_address_id = $deliv_address;
        $order->payment_id = $payment_id;
        $order->pickup_status = 0;
        $order->save();
        $id_order = $order->id;

        $detail = DB::table('order_details')->insertGetId([
            'orders_id' => $id_order,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description_order'),
            'weight' => $request->input('weight'),
            'volume' => $request->input('volume'),
            'receiver' => $request->input('receiver_name'),
            'phone' => $request->input('receiver_phone'),
            'description' => $request->input('description_address'),
            'delivery_fee' => $delivery_fee,
            'photo' => $img

        ]);
            $getCount = DB::table('count_driver_order')->where('id',$driver)->first();
        if(!empty($detail)){
            DB::table('drivers')
            ->where('user_id',$getCount->id)
            ->update(['total_orders' => $getCount->count]); 
            return response()->json("Order berhasil di buat", 200);
        }

        return response()->json("Order gagal di buat");

    }

    public function userListCustomer()
    {
        $data = DB::table('user_list')->where('role','customer')->get();
        $district = DB::table('districts')->get();
        $village = DB::table('villages')->get();
        $payment_methods = DB::table('payment_methods')->get();
        $del_fee_list = DB::table('delivery_fee_list')->get();
        if(!empty($data)){
            return response()->json([
                'data' => $data,
                'districts' =>$district,
                'village' =>$village,
                'methods' => $payment_methods,
                'del_fee_list' => $del_fee_list
            ], 200);
        }
        return response()->json('Data Tidak Ditemukan');
    }


    public function status(Request $request)
    {   
        date_default_timezone_set('Asia/Bangkok');
        $req = $request->all();
        foreach ($req as $key => $val) {
            if($val['status'] == 2){
                Order::join('payments','payments.id','orders.payment_id')
                     ->where('orders.id',intval($val['id']))
                     ->update([
                     'pickup_status' => 0 ,
                     'order_statuses_id' =>$val['status'],
                     'pickup_at' => date('Y-m-d H:i:s')
                     ]);
            //Barang diambil dengan talangan & ongkir di tanggung pengirim            
            }elseif($val['status'] == 3 && $val['bailout'] == 1 && $val['method'] == 1 ){
            $getAmount = DB::table('order_details')->where('orders_id',$val['id'])->select('price','delivery_fee')->get();
            $user_id = DB::table('orders')->where('id',$val['id'])->select('driver_id_pickup','no_order')->get();
            $wallet_id = DB::select('select id from wallet where user_id = '.intval($user_id[0]->driver_id_pickup).' AND CAST(created_at as DATE) = CURRENT_DATE');
            $debit = DB::table('wallet_transaction')
                        ->insert([
                            'wallet_id' => $wallet_id[0]->id,
                            'type' => 'debit',
                            'description' => 'Talangan Barang (#'.$user_id[0]->no_order.')',
                            'amount' => -$getAmount[0]->price 
                            ]);
            $credit = DB::table('wallet_transaction')
            ->insert([
                'wallet_id' => $wallet_id[0]->id,
                'type' => 'credit',
                'description' => 'Ongkir (#'.$user_id[0]->no_order.')',
                'amount' => $getAmount[0]->delivery_fee
                ]);
            Order::where('id',intval($val['id']))
             ->update([
                'pickup_status' => 1 ,
                'order_statuses_id' =>$val['status'],
                'bailout_id' => $val['bailout'],
                'pickup_at' => date('Y-m-d H:i:s')  
             ]);
             //Barang diambil tanpa talangan & ongkir di tanggung pengirim
            }elseif($val['status'] == 3 && $val['bailout'] == 2 && $val['method'] == 1 ){
                $getAmount = DB::table('order_details')->where('orders_id',$val['id'])->select('price','delivery_fee')->get();
                $user_id = DB::table('orders')->where('id',$val['id'])->select('driver_id_pickup','no_order')->get();
                $wallet_id = DB::select('select id from wallet where user_id = '.intval($user_id[0]->driver_id_pickup).' AND CAST(created_at as DATE) = CURRENT_DATE');
                $credit = DB::table('wallet_transaction')
                ->insert([
                    'wallet_id' => $wallet_id[0]->id,
                    'type' => 'credit',
                    'description' => 'Ongkir (#'.$user_id[0]->no_order.')',
                    'amount' => $getAmount[0]->delivery_fee
                    ]);
                Order::where('id',intval($val['id']))
                 ->update([
                    'pickup_status' => 1 ,
                    'order_statuses_id' =>$val['status'],
                    'bailout_id' => $val['bailout'],
                    'pickup_at' => date('Y-m-d H:i:s')  
                 ]);
                 //Barang diambil dengan talangan & ongkir di tanggung penerima
                }elseif($val['status'] == 3 && $val['bailout'] == 1 && $val['method'] == 2 ){
                $getAmount = DB::table('order_details')->where('orders_id',$val['id'])->select('price','delivery_fee')->get();
                $user_id = DB::table('orders')->where('id',$val['id'])->select('driver_id_pickup','no_order')->get();
                $wallet_id = DB::select('SELECT id from wallet where user_id ='.intval($user_id[0]->driver_id_pickup).' AND CAST(created_at as date) = CURRENT_DATE');
                $debit = DB::table('wallet_transaction')
                            ->insert([
                                'wallet_id' => $wallet_id[0]->id,
                                'type' => 'debit',
                                'description' => 'Talangan Barang (#'.$user_id[0]->no_order.')',
                                'amount' => -$getAmount[0]->price 
                                ]);
                Order::where('id',intval($val['id']))
                 ->update([
                    'pickup_status' => 1 ,
                    'order_statuses_id' =>$val['status'],
                    'bailout_id' => $val['bailout'],
                    'pickup_at' => date('Y-m-d H:i:s')  
                 ]);
                 //Barang diambil tanpa talangan & ongkir di tanggung penerima
                }elseif($val['status'] == 3 && $val['bailout'] == 2 && $val['method'] == 2 ){
                    Order::where('id',intval($val['id']))
                     ->update([
                        'pickup_status' => 1 ,
                        'order_statuses_id' =>$val['status'],
                        'bailout_id' => $val['bailout'],
                        'pickup_at' => date('Y-m-d H:i:s')  
                     ]);
                //Driver Assign
                }elseif($val['status'] == 4){
                Order::where('id',intval($val['id']))
                ->update([
                   'order_statuses_id' =>$val['status'],
                   'driver_id_deliver' =>$val['driver'],
                   'pickup_at' => date('Y-m-d H:i:s')  
                ]);
                //Barang diambil ongkir di tanggung pengirim
            }elseif($val['status'] == 3 && $val['bailout'] == 2 && $val['method'] == 3 ){
                $getAmount = DB::table('order_details')->where('orders_id',$val['id'])->select('price','delivery_fee')->get();
                $user_id = DB::table('orders')->where('id',$val['id'])->select('driver_id_pickup','no_order')->get();
                $wallet_id = DB::select('select id from wallet where user_id = '.intval($user_id[0]->driver_id_pickup).' AND CAST(created_at as date) = CURRENT_DATE');
                $credit = DB::table('wallet_transaction')
                ->insert([
                    'wallet_id' => $wallet_id[0]->id,
                    'type' => 'credit',
                    'description' => 'Ongkir (#'.$user_id[0]->no_order.')',
                    'amount' => $getAmount[0]->delivery_fee
                    ]);
                Order::where('id',intval($val['id']))
                 ->update([
                    'pickup_status' => 1 ,
                    'order_statuses_id' =>$val['status'],
                    'bailout_id' => $val['bailout'],
                    'pickup_at' => date('Y-m-d H:i:s')  
                 ]);
                 //Barang diambil ongkir di tanggung penerima
                }elseif($val['status'] == 3 && $val['bailout'] == 2 && $val['method'] == 4 ){
                    Order::where('id',intval($val['id']))
                     ->update([
                        'pickup_status' => 1 ,
                        'order_statuses_id' =>$val['status'],
                        'bailout_id' => $val['bailout'],
                        'pickup_at' => date('Y-m-d H:i:s')  
                     ]);
                //Barang diantar dengan tagihan
                }elseif($val['status'] == 5 && $val['method'] == 1 ){
                    $getAmount = DB::table('order_details')->where('orders_id',$val['id'])->select('price','delivery_fee')->get();
                    $user_id = DB::table('orders')->where('id',$val['id'])->select('driver_id_pickup','no_order')->get();
                    $wallet_id = DB::select('SELECT id from wallet where user_id ='.intval($user_id[0]->driver_id_deliver).' AND CAST(created_at as date) = CURRENT_DATE');
                    $credit = DB::table('wallet_transaction')
                                ->insert([
                                    'wallet_id' => $wallet_id[0]->id,
                                    'type' => 'credit',
                                    'description' => 'Pembayaran Barang (#'.$user_id[0]->no_order.')',
                                    'amount' => $getAmount[0]->price 
                                    ]);
                Order::where('id',intval($val['id']))
                ->update([
                   'order_statuses_id' =>$val['status'],
                   'delivered_at' => date('Y-m-d H:i:s')  
                ]);
            }
            //Barang diantar dengan tagihan dan ongkir
            elseif($val['status'] == 5 && $val['method'] == 2 ){
                $getAmount = DB::table('order_details')->where('orders_id',$val['id'])->select('price','delivery_fee')->get();
                $user_id = DB::table('orders')->where('id',$val['id'])->select('driver_id_pickup','no_order')->get();
                $wallet_id = DB::select('SELECT id from wallet where user_id ='.intval($user_id[0]->driver_id_deliver).' AND CAST(created_at as date) = CURRENT_DATE');
                $credit = DB::table('wallet_transaction')
                            ->insert([
                                'wallet_id' => $wallet_id[0]->id,
                                'type' => 'debit',
                                'description' => 'Pembayaran Barang (#'.$user_id[0]->no_order.')',
                                'amount' => $getAmount[0]->price 
                                ]);
                $credit2 = DB::table('wallet_transaction')
                ->insert([
                    'wallet_id' => $wallet_id[0]->id,
                    'type' => 'credit',
                    'description' => 'Ongkir (#'.$user_id[0]->no_order.')',
                    'amount' => $getAmount[0]->delivery_fee
                    ]);
            Order::where('id',intval($val['id']))
            ->update([
               'order_statuses_id' =>$val['status'],
               'delivered_at' => date('Y-m-d H:i:s')  
            ]);
            //Barang diantar tanpa tagihan dan ongkir
            }elseif($val['status'] == 5 && $val['method'] == 3 ){
            Order::where('id',intval($val['id']))
            ->update([
            'order_statuses_id' =>$val['status'],
            'delivered_at' => date('Y-m-d H:i:s')  
            ]);
            //Barang diantar dengan ongkir tanpa tagihan
            }elseif($val['status'] == 5 && $val['method'] == 4 ){
            $getAmount = DB::table('order_details')->where('orders_id',$val['id'])->select('price','delivery_fee')->get();
            $user_id = DB::table('orders')->where('id',$val['id'])->select('driver_id_pickup','no_order')->get();
            $wallet_id = DB::select('SELECT id from wallet where user_id ='.intval($user_id[0]->driver_id_deliver).' AND CAST(created_at as date) = CURRENT_DATE');
            $credit2 = DB::table('wallet_transaction')
                ->insert([
                    'wallet_id' => $wallet_id[0]->id,
                    'type' => 'credit',
                    'description' => 'Ongkir (#'.$user_id[0]->no_order.')',
                    'amount' => $getAmount[0]->delivery_fee
                    ]);
            Order::where('id',intval($val['id']))
            ->update([
            'order_statuses_id' =>$val['status'],
            'delivered_at' => date('Y-m-d H:i:s')  
            ]);
            //Cancel Order
            }elseif($val['status'] == 6){
                Order::where('id',intval($val['id']))
                ->update([
                   'order_statuses_id' =>$val['status'],  
                ]);
               }
            //Retur 
            elseif($val['status'] == 7){
                DB::table('return')->insert(['id_orders' => intval($val['id'])]);
                Order::where('id',intval($val['id']))
                ->update([
                   'order_statuses_id' =>$val['status'],  
                ]);
               }
            //Pengiriman Ulang
            elseif($val['status'] == 8){
            Order::where('id',intval($val['id']))
            ->update([
                'order_statuses_id' =>$val['status'],  
            ]);
            }
        }
        return redirect('admin/order/pickup');
    }

    public function orderHistory()
    {
        try {
            $data = DB::table('history_orders')->get();

            return response()->json(['data' =>$data], 200);
            
        } catch (\Exception $e) {
            return response()->json('Belum Ada History', 200);
        }
    }

    public function detailOrder($no_order)
 {
     $data = DB::table('detail_orders')
                ->where('no_order',$no_order)    
                ->get();

     if($data){
         return response()->json([
             'data' => $data
         ]);
     }
     return response()->json('Data Not Found',401);
 }

 public function area()
 {
    $district = DB::table('districts')->get();
    $village = DB::table('villages')->get();

    return response()->json([
        'district' => $district,
        'village' => $village
        ]);
 }

 public function editOrder($no_order)
 {
     $data = DB::table('edit_orders')
                ->where('no_order',$no_order)    
                ->get();

     if($data){
         return response()->json([
             'data' => $data
         ]);
     }
     return response()->json('Data Not Found',401);
 }


 public function updateOrder(Request $request)
 {
     $this->validate($request, [
         'name'  => 'required',
         'weight' => 'required',
         'volume' =>'required',
         'price' => 'required',
         'user_id' =>'required',
         'order_id' =>'required',
         'district' =>'required',
         'payment_method' =>'required',
         'payment_method' =>'required',
         // 'photo' => 'required|image',
     ]);
  
    $user_id = $request->input('user_id');
    $id = $request->input('order_id');

     //insert photo
     if ($request->hasFile('photo')) 
     { 
         $fileExtension = $request->file('photo')->getClientOriginalName(); 
         $file = pathinfo($fileExtension, PATHINFO_FILENAME); 
         $extension = $request->file('photo')->getClientOriginalExtension();
         $fileStore = $file . '_' . time() . '.' . $extension; 
         $img = 'http://192.168.18.60:8000/photo/product/'. base64_encode($fileStore);
         $path = $request->file('photo')->storeAs('photo/product',$fileStore); 
     } else{
         $img = $request->input('photo');
     }

     //Create Delivery Address
     $deliv_address = DB::table('delivery_addresses')->where('id',$request->input('delivery_address_id'))
        ->update([
         'address' =>   $request->input('receiver_address'),
         'description' =>  $request->input('description_address'),
         'district' =>  $request->input('district')
     ]);
      

     $detail = DB::table('order_details')->where('orders_id', $id)->Update([
         'name' => $request->input('name'),
         'price' => $request->input('price'),
         'description' => $request->input('description_order'),
         'weight' => $request->input('weight'),
         'volume' => $request->input('volume'),
         'receiver' => $request->input('receiver_name'),
         'phone' => $request->input('receiver_phone'),
         'description' => $request->input('description_address'),
         'delivery_fee' => $request->input('delivery_fee'),
         'photo' => $img

     ]);

     if($detail){
         return response()->json("Data Updated Successfully", 200);
     }

     return response()->json("Data Failed to Update");

 }

    //Driver

    public function driverList()
    {
        $getDriver = DB::table('driver_list')->get();
        $district = DB::table('districts')->get();
        $village = DB::table('villages')->get();
        $driver =[];
        if(!empty($getDriver)){
        foreach ($getDriver as $val) {
            $d = str_replace(str_split('\\[]"'), '', $val->village_placement_id);
            $e =explode(',',$d);
            $village_placement = array();
            if($val->village_placement_id !== null){
            foreach ($e as $v){
                $get = DB::table('village')->where('id',$v)->first('nama')->nama;     
                array_push($village_placement,$get);
            }
            }
          
            $arr = array(
           'id' => $val->id,
           'name' => $val->name,
           'email' => $val->email,
           'total_order' => $val->count,
           'category' => $val->category,
           'district_placement' => $val->district_placement,
           'village_placement' => $village_placement,
           'driver_district' => $val->driver_district,
           'driver_village' => $val->driver_village,
           'phone' => $val->phone,
           'photo' => $val->photo,
       );
       array_push($driver,$arr);
    }
    }

    return response()->json([
        
        'driver' => $driver ,
        'district' =>$district,
        'village' =>$village,

        ], 200);
        }
    public function driverFilterList(Request $request)
    {
        $req = $request->all();
        $district = DB::select('
                        SELECT
                        delivery_addresses.district
                        FROM
                        delivery_addresses
                        INNER JOIN
                        orders
                        ON 
                        delivery_addresses.id = orders.delivery_address_id
                        WHERE orders.id = '.$req[0]['id']);
        $data = DB::table('driver_list')->where('district_placement_id',$district[0]->district)->select('id','name')->get();
        if(!empty($data)){
            return response()->json(['data' => $data], 200);
        }
        return response()->json('Data Not Found', 200);
    }

    public function changeDriverFilterList(Request $request)
    {
        $req = $request->all();
        $district = DB::select('
                            SELECT
                            orders.user_id, 
                            user_profiles.user_id, 
                            user_profiles.district_id AS district, 
                            user_profiles.village_id AS village
                        FROM
                            orders
                            INNER JOIN
                            user_profiles
                            ON 
                            orders.user_id = user_profiles.user_id
                            WHERE orders.id = '.$req[0]['id']);
        $data = DB::table('driver_list')->where('district_placement_id',$district[0]->district)->where('village_placement_id', 'like', '%'.$district[0]->village.'%')->select('id','name')->get();
        if(!empty($data)){
            return response()->json(['data' => $data], 200);
        }
        return response()->json('Data Not Found', 200);
    }

    public function DeliveryDriverFilterList(Request $request)
    {
        $req = $request->all();
        $district = DB::select('
                            SELECT
                            orders.user_id, 
                            delivery_addresses.district,
                            delivery_addresses.village
                            FROM
                            orders
                            INNER JOIN
                            delivery_addresses
                            ON 
                            orders.delivery_address_id = delivery_addresses.id
                            WHERE orders.id = '.$req[0]['id']); 
        
        $data = DB::table('driver_list')->where('district_placement_id',$district[0]->district)->select('id','name')->get();
        if(!empty($data)){
            return response()->json(['data' => $data], 200);
        }
        return response()->json('Data Not Found', 200);
    }

    public function driverAssignRedelivery(Request $request)
    {
        $req = $request->all();
        $update = DB::table('orders')->where('id',$req[0]['id'])->Update([
            'driver_id_redeliver' => $req[0]['driver']
        ]);

        if($update){
            return response()->json('Data Updated Successfully', 200);
        }
        return response()->json('Data Update Failed');
    }

    public function show($no_order)
    {
        $order = DB::table('list_orders_pickedup')->where('no_order',$no_order)->first();
        if(!empty($order)){
        $date = date_create($order->order_date);    
        $data = array(
                    'id' => intval($order->id),
                    'no_order' => $order->no_order,
                    'client' => $order->name,
                    'date' => date_format($date,'d-M-y') ,
                    'delivery_fee' => intval($order->delivery_fee),
                    'product_name' => $order->product_name,
                    'order_status' => $order->order_status,
                    'payment_status' => $order->payment_status,
                    'payment_method' => $order->method,
                    'sender_address' => $order->sender_address,
                    'sender_phone' => $order->sender_phone,
                    'receiver_name' => $order->receiver_name,
                    'receiver_phone' => $order->receiver_phone,
                    'receiver_address' => $order->receiver_address,
                    'receiver_district' => $order->receiver_district,
                    'price' => intval($order->price),
                    'total' => $order->price + $order->delivery_fee,
                    'driver_name' => $order->driver_name
        );
        
        $d = DB::table('driver_list')->where('district_placement',$order->receiver_district)->get();
        $driver = array();
        foreach($d as $val){
            $arr = array(
                'id' => intval($val->id),
                'name' => $val->name
            );

            array_push($driver,$arr);
        }
        
            return response()->json(['order' => $data , 'driver' => $driver], 200);
      }
        return response()->json('Data Not Found', 200);
    } 

    public function deliveryAssign(Request $request)
    {
        $update = DB::table('orders')->where('id',$request->input('id'))
                    ->update([
                        'order_statuses_id' => 4,
                        'driver_id_deliver' => $request->input('id_driver'),
                        ]);
        return response()->json('Data Updated Successfully', 200);
        
    }
 
    public function changeDriverPickUp(Request $request)
    {
        $req = $request->all();
        $update = DB::table('orders')->where('id',$req[0]['id'])->Update([
            'driver_id_pickup' => $req[0]['driver']
        ]);

        if($update){
            return response()->json('Data Updated Successfully', 200);
        }
        return response()->json('Data Update Failed');
    }

    public function changeDriverDelivery(Request $request)
    {
        $req = $request->all();
        $update = DB::table('orders')->where('id',$req[0]['id'])->Update([
            'driver_id_deliver' => $req[0]['driver']
        ]);

        if($update){
            return response()->json('Data Updated Successfully', 200);
        }
        return response()->json('Data Update Failed');
    }
 
}
