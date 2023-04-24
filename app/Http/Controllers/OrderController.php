<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Order\StoreRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{


    public function show()
    {
        $user_orders = auth()->user()->orders()->get();
        foreach($user_orders as $uo){
       
           $uo2 = [
             'id' => $uo->id,
             'text' => $uo->text,
             'user_id' => $uo->user_id,
             'category_id' => $uo->category_id,
             'published' => $uo->published,
             'created_at' => $uo->created_at,
             'created_at' => $uo->updated_at,
             'category' => $uo->category->name
           ];
           $uo3[] = $uo2;
        }
       return $uo3;
    }

    public function add(StoreRequest $request)
    {
        $data = $request->validated();
       
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'category_id' => $data['category_id'],
            'text' => $data['text'],
            'published' => 1
        ]);

        return $order;
    }

    public function last()
    {
        $lasts = Order::latest()->limit(5)->get();
         
        foreach($lasts as $last){
       
            $last2 = [
              'id' => $last->id,
              'text' => $last->text,
              'user_id' => $last->user_id,
              'category_id' => $last->category_id,
              'created_at' => $last->created_at,
              'category' => $last->category->name
            ];
            $last3[] = $last2;
         }

        return $last3;
    }

    public function allOrders(Request $request)
    {
      
        $allOrders = Order::paginate(20, ['*'], 'page', $request['page']);
          
        foreach($allOrders as  $allOrder){
       
            $allOrders2 = [
              'id' => $allOrder->id,
              'text' => $allOrder->text,
              'user_id' => $allOrder->user_id,
              'category_id' => $allOrder->category_id,
              'created_at' => $allOrder->created_at,
              'category' => $allOrder->category->name,
            ];
            $allOrders3[] = $allOrders2;
         }

        return $allOrders;
    }

    public function single(Order $order)
    {
        $order['category'] = $order->category;
        return $order;
    }

    public function update(StoreRequest $request, Order $order)
    {
        $data = $request->validated();
        $order->update($data);

        return $order;
    }

    public function count(Order $order)
    {
        if($order->view === null){
            $order->update(['view' => 1]);
        } else {
            $order->increment('view', 1);
        }
       
    }

    public function delete(Order $order)
    {
       
        $order->delete();
        
        return response([]);
       
    }
}
