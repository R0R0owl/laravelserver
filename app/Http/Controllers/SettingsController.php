<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class SettingsController extends Controller
{
    public function edit()
    {
        // 必要な変数をビューに渡す
        return view('settings.edit', [
            'prompt' => session('prompt', ''),  // セッションまたはデフォルト値を使用
            'negative_prompt' => session('negative_prompt', ''),
            'step_count' => session('step_count', 20),  // デフォルトで50
        ]);
    }

    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'prompt' => 'required|string',
            'negative_prompt' => 'nullable|string',
            'step_count' => 'required|integer|min:1|max:1000',
        ]);

        // 設定を保存する処理（例としてセッションに保存）
        session([
            'prompt' => $request->prompt,
            'negative_prompt' => $request->negative_prompt,
            'step_count' => $request->step_count,
        ]);

        // 保存後にリダイレクト
        return redirect()->route('settings.edit')->with('success', '設定が更新されました！');
    }
}
