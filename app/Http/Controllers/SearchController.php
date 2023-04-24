<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Organization;
use App\Models\Order;

class SearchController extends Controller
{
    public function searchOrgs($text)
    {
        $organizations = Organization::where('description', 'LIKE', "%{$text}%")
        ->orWhere('name', 'LIKE', "%{$text}%")
        ->orderBy('created_at', 'DESC')->paginate(20);

        foreach($organizations as $org){
           $org['images'] = $org->images;
        }

        return $organizations;

    }

    public function searchOrders($text)
    {
         $orders = Order::where('text', 'LIKE', "%{$text}%")
        ->orderBy('created_at', 'DESC')->paginate(20);

        foreach($orders as $ord){
            $ord['category'] = $ord->category;
         }

        return $orders;
    }
}
