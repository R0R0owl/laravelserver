<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GreatManaged;

class GreatController extends Controller
{
    /**
     * 偉人一覧表示
     */
    public function index()
    {
        $greatmanaged = GreatManaged::all();
        return view('greatmanaged', compact('greatmanaged'));
        // return ($greatmanaged;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * 新規人物登録
     */
    public function store(Request $request)
    {
        //バリデーション
        $request->validate(GreatManaged::rules());

        //情報保存
        GreatManaged::create([
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'lastyear' => $request->input('lastyear'),
        ]);

        //保存後メッセージ
        return redirect()->route('greatmanaged')->with('success', '人物が作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * 人物編集
     */
    public function edit($id)
    {
        $greatmanaged = GreatManaged::findOrFail($id);
        return view('greatmanagededit', compact('greatmanaged'));
        // return $greatmanaged;
    }

    /**
     * 編集
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|max:2025',
            'lastyear' => 'required|integer|max:2025',
        ]);

        //情報取得
        $greatmanaged = GreatManaged::findOrFail($id);

        //更新
        $greatmanaged->update([
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'lastyear' => $request->input('lastyear'),
        ]);

        return redirect()->route('greatmanaged', ['id' => $greatmanaged->id])->with('success', '人物情報が更新されました');
    }

    /**
     * 人物削除
     */
    public function destroy($id)
    {
        //id取得
        $greatmanaged = GreatManaged::findOrFail($id);

        //削除
        $greatmanaged->delete();

        //削除後リダイレクト
        return redirect()->route('greatmanaged')->with('success', '人物が削除されました');
    }
}
