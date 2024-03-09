<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TotalController extends Controller
{
    public function quater_1(){
        $startDate = '2022-01-00 00:00:00';
        $endDate   = '2022-03-31 23:59:59';
        $users = DB::table('user')->get();
        $year_quater = '2022 and quater one';
        $totalDebit = DB::table('order')
                ->whereBetween('updated_at', array($startDate,$endDate))
                ->get();
        $total = 0;
        $status5 = 0;
        $status4 = 0;
        $status = 0;
        $status7 = 0;
        foreach($totalDebit as $price_total) {
            if($price_total->status != 'ready'){
                if($price_total->status == 4){
                    $status4 ++;
                    $total += $price_total->total_price;
                }elseif($price_total->status ==5){
                    $status5 ++;
                }elseif($price_total->status ==7){
                    $status7 ++;
                }else{
                    $status ++;
                }
            }
        }
        $amount = $status7 + $status4 ;
        $ship = $amount * 40000;
        return view('admin.total.quater',['orders'=>$totalDebit,'users'=>$users,'total'=>$total,'year'=>$year_quater,'status5'=>$status5,'status4'=>$status4,'status7'=>$status7,'status'=>$status,'ship'=>$ship]);
       }
       public function post_quater(Request $request){
        $years = $request->only('year');
        $datas = $request->only('quater');
        
        foreach($datas as $data){
            foreach($years as $year){
                if(empty($data) || empty($year) ){
                    return redirect()->route('admin.total.quater_1')->with('error', 'Enter year and quater');
                }else {
                    return redirect()->route('admin.total.get_quater',['year'=>$year,'quater'=>$data]);
                }
            }
        }
       }
       public function get_quater($year,$quater){
        if($quater == 1){
            $startDate = $year.'-01-00 00:00:00';
            $endDate   = $year.'-03-31 23:59:59';
            $users = DB::table('user')->get();
            $year_quater= $year.' and quater one';
            $totalDebit = DB::table('order')
                    ->whereBetween('updated_at', array($startDate,$endDate))
                    ->get();
            $total = 0;
            $status5 = 0;
            $status4 = 0;
            $status = 0;
            $status7 = 0;
            foreach($totalDebit as $price_total) {
                if($price_total->status != 'ready'){
                    if($price_total->status == 4){
                        $status4 ++;
                        $total += $price_total->total_price;
                    }elseif($price_total->status ==5){
                        $status5 ++;
                    }elseif($price_total->status ==7){
                        $status7 ++;
                    }else{
                        $status ++;
                    }
                }
            }
            $amount = $status7 + $status4 ;
            $ship = $amount * 40000;
            return view('admin.total.quater',['orders'=>$totalDebit,'users'=>$users,'total'=>$total,'year'=>$year_quater,'status5'=>$status5,'status4'=>$status4,'status7'=>$status7,'status'=>$status,'ship'=>$ship]);
        }elseif($quater == 2){
            $startDate = $year.'-04-00 00:00:00';
            $endDate   = $year.'-06-31 23:59:59';
            $users = DB::table('user')->get();
            $year_quater= $year.' and quater two';
            $totalDebit = DB::table('order')
                    ->whereBetween('updated_at', array($startDate,$endDate))
                    ->get();
            $total = 0;
            $status5 = 0;
            $status4 = 0;
            $status = 0;
            $status7 = 0;
            foreach($totalDebit as $price_total) {
                if($price_total->status != 'ready'){
                    if($price_total->status == 4){
                        $status4 ++;
                        $total += $price_total->total_price;
                    }elseif($price_total->status ==5){
                        $status5 ++;
                    }elseif($price_total->status ==7){
                        $status7 ++;
                    }else{
                        $status ++;
                    }
                }
            }
            $amount = $status7 + $status4 ;
            $ship = $amount * 40000;
            return view('admin.total.quater',['orders'=>$totalDebit,'users'=>$users,'total'=>$total,'year'=>$year_quater,'status5'=>$status5,'status4'=>$status4,'status7'=>$status7,'status'=>$status,'ship'=>$ship]);
        }elseif($quater == 3){
            $startDate = $year.'-07-00 00:00:00';
            $endDate   = $year.'-09-31 23:59:59';
            $year_quater= $year.' and quater three';
            $users = DB::table('user')->get();
            $totalDebit = DB::table('order')
                    ->whereBetween('updated_at', array($startDate,$endDate))
                    ->get();
            $total = 0;
            $status5 = 0;
            $status4 = 0;
            $status = 0;
            $status7 = 0;
            foreach($totalDebit as $price_total) {
                if($price_total->status != 'ready'){
                    if($price_total->status == 4){
                        $status4 ++;
                        $total += $price_total->total_price;
                    }elseif($price_total->status ==5){
                        $status5 ++;
                    }elseif($price_total->status ==7){
                        $status7 ++;
                    }else{
                        $status ++;
                    }
                }
            }
            $amount = $status7 + $status4 ;
            $ship = $amount * 40000;
            return view('admin.total.quater',['orders'=>$totalDebit,'users'=>$users,'total'=>$total,'year'=>$year_quater,'status5'=>$status5,'status4'=>$status4,'status7'=>$status7,'status'=>$status,'ship'=>$ship]);
            }elseif($quater == 4){
            $startDate = $year.'-10-00 00:00:00';
            $endDate   = $year.'-12-31 23:59:59';
            $year_quater= $year.' and quater four';
            $users = DB::table('user')->get();
            $totalDebit = DB::table('order')
                    ->whereBetween('updated_at', array($startDate,$endDate))
                    ->get();
            $total = 0;
            $status5 = 0;
            $status4 = 0;
            $status = 0;
            $status7 = 0;
            foreach($totalDebit as $price_total) {
                if($price_total->status != 'ready'){
                    if($price_total->status == 4){
                        $status4 ++;
                        $total += $price_total->total_price;
                    }elseif($price_total->status ==5){
                        $status5 ++;
                    }elseif($price_total->status ==7){
                        $status7 ++;
                    }else{
                        $status ++;
                    }
                }
            }
            $amount = $status7 + $status4 ;
            $ship = $amount * 40000;
            return view('admin.total.quater',['orders'=>$totalDebit,'users'=>$users,'total'=>$total,'year'=>$year_quater,'status5'=>$status5,'status4'=>$status4,'status7'=>$status7,'status'=>$status,'ship'=>$ship]);
        }else {
            return redirect()->route('admin.total.quater_1')->with('error', 'Does not exists');
        }
       }
       public function total_month(){
        $startDate = '2022-01-00 00:00:01';
        $endDate   = '2022-01-31 23:59:59';
        $users = DB::table('user')->get();
        $month = 'Month One year 2022';
        $totalDebit = DB::table('order')
                ->whereBetween('updated_at', array($startDate,$endDate))
                ->get();
        $total = 0;
        $status5 = 0;
        $status4 = 0;
        $status = 0;
        $status7 = 0;
        foreach($totalDebit as $price_total) {
            if($price_total->status != 'ready'){
                if($price_total->status == 4){
                    $status4 ++;
                    $total += $price_total->total_price;
                }elseif($price_total->status ==5){
                    $status5 ++;
                }elseif($price_total->status ==7){
                    $status7 ++;
                }else{
                    $status ++;
                }
            }
        }
        $amount = $status7 + $status4 ;
        $ship = $amount * 40000;
        return view('admin.total.month',['orders'=>$totalDebit,'users'=>$users,'total'=>$total,'month'=>$month,'status5'=>$status5,'status4'=>$status4,'status7'=>$status7,'status'=>$status,'ship'=>$ship]);
       }
    
       public function post_total_month(Request $request){
        $years = $request->only('year');
        $datas = $request->only('month');
        foreach($years as $year){
        foreach($datas as $data){
            if(empty($data)|| empty($year)){
                return redirect()->route('admin.total.total_month')->with('error', 'Enter year and month');
            }else {
                return redirect()->route('admin.total.get_total_month',['year'=>$year,'month'=>$data]);
            }
       }
    } 
}
       public function get_total_month($year, $month){
        switch($month){
            case 1: {
                $months = 'Month 1 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = '2022-'.$month.'-31 23:59:59';
                break;
            }
            case 2: {
                $months = 'Month 2 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 3: {
                $months = 'Month 3 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 4: {
                $months = 'Month 4 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 5: {
                $months = 'Month 5 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 6: {
                $months = 'Month 6 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 7: {
                $months = 'Month 7 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 8: {
                $months = 'Month 8 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 9: {
                $months = 'Month 9 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 10: {
                $months = 'Month 10 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 11: {
                $months = 'Month 11 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            case 12: {
                $months = 'Month 12 year '.$year;
                $startDate = $year.'-'.$month.'-00 00:00:01';
                $endDate   = $year.'-'.$month.'-31 23:59:59';
                break;
            }
            default : {
                return redirect()->route('admin.total.total_month')->with('error', 'month not exists');
            }
        }$users = DB::table('user')->get();
        $totalDebit = DB::table('order')
                ->whereBetween('updated_at', array($startDate,$endDate))
                ->get();
        $total = 0;
        $status5 = 0;
        $status4 = 0;
        $status = 0;
        $status7 = 0;
        foreach($totalDebit as $price_total) {
            if($price_total->status != 'ready'){
                if($price_total->status == 4){
                    $status4 ++;
                    $total += $price_total->total_price;
                }elseif($price_total->status ==5){
                    $status5 ++;
                }elseif($price_total->status ==7){
                    $status7 ++;
                }else{
                    $status ++;
                }
            }
        }
        $amount = $status7 + $status4 ;
        $ship = $amount * 40000;
        return view('admin.total.month',['orders'=>$totalDebit,'users'=>$users,'total'=>$total,'month'=>$months,'status5'=>$status5,'status4'=>$status4,'status7'=>$status7,'status'=>$status,'ship'=>$ship]);
       }
}
