<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Prompts; 

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prompt = Prompts::all();
        $images = session('images', []); // セッションから画像を取得
    
        return view('image', compact('images', 'prompt'));
    }

    //動的データ取得用
    public function getPromptData($id)
    {
        //idに基づいてデータ取得
        $prompt = Prompts::find($id);

        if ($prompt) {
            return response()->json($prompt);
        }

        return response()->json(['error' => 'データが見つかりません'], 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //idにひもずいたデータ
        $promptData = Prompts::find($id);

        //データがなければエラー
        if (!$promptData) {
            return redirect()->route('prompts.index')->with('error', 'データが見つかりません');
        }

        return view('image', compact('promptData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'id' => 'required|integer|min:1'
        ], [
            'id.required' => 'IDを選択してください。',
        ]);
    
        // フォームデータの取得
        $id = $request->input('id');
        $selectedPrompt = $request->input('selected_prompt');
        $selectedNegativePrompt = $request->input('selected_negative_prompt');
        $selectedSteps = $request->input('selected_steps');
    
        // APIリクエスト
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://10.42.112.8:32766/sdapi/v1/txt2img', [
            'prompt' => $selectedPrompt,
            'negative_prompt' => $selectedNegativePrompt,
            'step' => $selectedSteps,
        ]);
    
        // レスポンスから画像取得
        $images = $response->json('image');

        if (!empty($images)) {
            session()->flash('images', $images);
        }
      
        // リダイレクト
        return redirect()->route('image.index');
        // return $response;

    }
    
} 
