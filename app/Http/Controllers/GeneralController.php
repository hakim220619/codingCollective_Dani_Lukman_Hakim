<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{

    function home()
    {
        // dd(Session::get('id'));
        if (!Session::get('id')) {
            return view('welcome');
        } else {
            $data['deposit'] = DB::table('deposit')->where('user_id', Session::get('id'))->get();
            return view('welcome', $data);
        }
    }
    public function getToken(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $user = User::where('name', $request->name)->first();
        $token = $user->createToken($request->name);
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'data' => $user,
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $session = User::where('name', $request->name)->first();
        Session::put('id', $session->id);
        Session::put('name', $session->name);
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    function saldo()
    {
        $in = DB::table('deposit')->where('user_id', request()->user()->id)->where('state', 'IN')->sum('amount');
        $out = DB::table('deposit')->where('user_id', request()->user()->id)->where('state', 'OUT')->sum('amount');
        return response()->json([
            'success' => true,
            'message' => 'Data Saldo',
            'saldo IN' => $in,
            'saldo OUT' => $out,
            'saldo' => $in - $out
        ]);
    }
    function deposit()
    {
        $data = DB::table('deposit')->where('user_id', request()->user()->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Deposit Success',
            'data' => $data,
        ]);
    }
    function inputDeposit(Request $request)
    {
        try {
            $data = [
                'user_id' => request()->user()->id,
                'order_id' => rand(000000, 999999),
                'amount' => str_replace(',', '', number_format($request->amount, 2)),
                'state' => 'IN',
                'created_at' => now()
            ];
            DB::table('deposit')->insert($data);
            return response()->json([
                'success' => true,
                'message' => 'Deposit Success',
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Deposit Failed'
            ]);
        }
    }
    function withdrawal(Request $request)
    {
        try {
            $data = [
                'user_id' => request()->user()->id,
                'order_id' => rand(000000, 999999),
                'amount' => str_replace(',', '', number_format($request->amount, 2)),
                'state' => 'OUT'
            ];
            DB::table('deposit')->insert($data);
            return response()->json([
                'success' => true,
                'message' => 'withdrawal Success',
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'withdrawal Failed'
            ]);
        }
    }
}
