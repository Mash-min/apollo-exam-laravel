<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Random;
use Illuminate\Support\Str;


class RandomsController extends Controller
{
    public function create()
    {
        $arrays = [5, 6, 7, 8, 9, 10];
        $randomArr = collect([]);
        $breakdownArr = collect([]);
     
        foreach($arrays as $array) {
            $randomArr->push(Str::random($array));
            $breakdownArr->push(Str::random($array));
        }

        foreach($randomArr as $rand) {
            $random = Random::create(['value' => $rand]);
            foreach($breakdownArr as $bd) {
                $random->breakdowns()->create(['value' => $bd]);
            }
        }

        $randoms = Random::orderBy('created_at', 'DESC')
                        ->where('flag', false)
                        ->with('breakdowns')
                        ->get();     
        
        foreach($randoms as $random) {
            $random->update(['flag' => true]);
        }       

        return response()->json(['randoms' => $randoms]);
    }

    public function randoms()
    {
        $randoms = Random::orderBy('created_at', 'DESC')
                         ->where('flag', false)
                         ->with('breakdowns')
                         ->get();    
        foreach($randoms as $random) {
            $random->update(['flag' => true]);
        }             

        return response()->json(['randoms' => $randoms]);                                    
    }
}
