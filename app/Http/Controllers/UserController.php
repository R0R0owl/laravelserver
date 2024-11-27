<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * 利用者一覧表示
     */
    public function index()
    {
        $customer = Customer::all();

        return view('usermanage', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * 新規利用者登録
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',         // 名前は必須、文字列、最大255文字
            'email' => 'required|email|max:255',       // メールは必須、文字列、最大255文字
            'password' => 'required|string|confirmed|max:255',     // パスワードは必須、文字列、最大255文字
        ], [
            'password.confirmed' => 'パスワードが一致しません。もう一度入力してください', //確認用パスワードと違ったらエラー表示
        ]);

        //保存
        Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        //メッセージ
        return redirect()->route('adminuser')->with('success', '利用者が登録されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * 編集したい利用者
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('useredit', compact('customer'));
    }

    /**
     * 編集
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',         // 名前は必須、文字列、最大255文字
            'email' => 'required|email|max:255',       // メールは必須、文字列、最大255文字
            'password' => 'required|string|confirmed|max:255',     // パスワードは必須、文字列、最大255文字
        ], [
            'password.confirmed' => 'パスワードが一致しません。もう一度入力してください', //確認用パスワードと違ったらエラー表示
        ]);
    
        // 利用者取得
        $customer = Customer::findOrFail($id);
        
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];
    
        // パスワードが指定されていたらハッシュ化
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password')); // Corrected 'password'
        }
    
        // データの更新
        $customer->update($data);
    
        return redirect()->route('adminuser', ['id' => $customer->id])->with('success', '利用者情報が変更されました');
    }

    /**
     * 利用者削除
     */
    public function destroy($id)
    {
        //id取得
        $customer = Customer::findOrFail($id);

        //削除
        $customer->delete();

        //削除後リダイレクト
        return redirect()->route('adminuser')->with('success', 'プロンプトが削除されました');
    }
}
