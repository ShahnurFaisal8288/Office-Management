<?php

namespace App\Http\Controllers;

use App\Models\CashInHand;
use Illuminate\Http\Request;

class CashInHandController extends Controller
{
    //cashInHand
    public function cashHand()
    {
        CashInHand::create([
            'amount' => request('amount'),
            'note' => request('note'),
        ]);
        return back()->with('message','Cash In Hand Boosted Successfully');
    }
}
