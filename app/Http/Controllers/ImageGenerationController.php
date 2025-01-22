<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageGenerationController extends Controller
{
    public function createPrompt(Request $request) {
        // プロンプト取得
        $prompt = $request->input('prompt');
        $negative_prompt = $request->imput('negative_prompt');
        $steps = $request->input('steps');

        //stable diffusion APIのURL
        $stable_diffusion_url = 'http://10.42.112.8:32766/sdapi/v1/txt2imgg';

        //apiへPOSTリクエスト
        $response = Http::post($stable_diffusion_url, [
            'prompt' => $prompt,                      //プロンプト
            'negative_prompt' => $negative_prompt,    //ネガティブプロンプト
            'steps' => $steps,                        //ステップ数
            'width' => 512,                           //幅
            'height' => 512,                          //高さ
        ]);

        //生成されたかの確認
        if ($response->successful()) {
            //生成された画像をBase64で取得
            $image_data = $response->json()['images'][0];   //Base64形式データ
            $image = base64_decode($image_data);

            //ファイルで保存
            $file_path = 'generated_images/' . uniqid() . '.png';
            file_put_contents(public_path($file_path), $image);

            return response()->json([
                'message' => 'Image generated successfully',
                'image_url' => asset($file_path),
            ]);
        } else {
            return response()->json(['message' => 'Failed to generate image'], 500);   //取得できなかったらエラーメッセエージ
        }
    }

    public function generateImage() {
        return view('form');
    }
}