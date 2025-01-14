<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompts;

class PromptsController extends Controller
{
    /*
     * プロンプト一覧表示
     */
    public function index()
    {
        $prompt = Prompts::all();

        return view('prompts', compact('prompt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * 新しくプロンプト作成
     */
    public function store(Request $request)
    {
        //バリデーション
        $request->validate(Prompts::rules());

        //プロンプト保存
        Prompts::create([
            'prompt' => $request->input('prompt'),
            'negative_prompt' => $request->input('negative_prompt'),
            'step' => $request->input('steps'),
        ]);

        //保存後メッセージ
        return redirect()->route('prompts')->with('success', 'プロンプトが作成されました');
    }
    
    public function showForm()
    {
        $prompt = '';
        $negative_prompt = '';
        $step_count = 20;
    
        return view('your_view_name', compact('prompt', 'negative_prompt', 'step_count'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * プロンプト編集
     */
    public function edit($id)
    {
        $prompt = Prompts::findOrFail($id);
        return view('promptedit', compact('prompt'));
    }

    /**
     * 編集
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'prompt' => 'required|string|max:1000',
            'negative_prompt' => 'required|string|max:1000',
            'step_count' => 'required|integer|min:20|max:50',
        ]);

        //プロンプト取得
        $prompt = Prompts::findOrFail($id);

        $prompt->update([
            'prompt' => $request->input('prompt'),
            'negative_prompt' => $request->input('negative_prompt'),
            'step' => $request->input('step_count'),
        ]);

    return redirect()->route('prompts', ['id' => $prompt->id])->with('success', 'プロンプトが更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //id取得
        $prompt = Prompts::findOrFail($id);

        //削除
        $prompt->delete();

        //削除後にリダイレクト
        return redirect()->route('prompts')->with('success', 'プロンプトが削除されました');
    }
}
