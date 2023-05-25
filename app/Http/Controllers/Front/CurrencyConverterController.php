<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'currency_code'=>'required|string|min:2|max:3',
        ]);
        $baseCurrency=config('app.currency');
        $currencyCode=$request->input('currency_code');
     /*   Session::put('currency_code',$currencyCode);

        $rates=Cache::get('currency_code',[]);
        if(!isset($rates[$currencyCode])){
            $converter=new CurrencyConverter(config('service.currency_converter.api_key'));
            $rate=$converter->convert($baseCurrency,$currencyCode);
        }
        Session::put('currency_rate',$rate);

        Cache::put('currency_rate',$rate,now()->addMinutes(60));*/
        $rates=Cache::get('currency_code',[]);
        if(!isset($rates[$currencyCode])){
            $converter=new CurrencyConverter(config('service.currency_converter.api_key'));
            $rate=$converter->convert($baseCurrency,$currencyCode);
            //Session::put('currency_code',$currencyCode);
            $rates[$currencyCode]=$rate;
            Cache::put('currency_rates',$rates,now()->addMinutes(60));


        }

    }
}
