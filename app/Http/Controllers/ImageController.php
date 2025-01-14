<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompts; 

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prompt = Prompts::all();
        return view('image', compact('prompt'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
