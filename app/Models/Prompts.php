<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Prompts extends Model
{
    use HasFactory;

    protected $table = 'promptsv2';

    protected $fillable =[ 
        'prompt', 
        'negative_prompt', 
        'step',
    ];

    /**
     * バリデーション
     */
    public static function rules()
    {
        return [
            'prompt' => 'required|string|max:1000',
            'negative_prompt' => 'required|string|max:1000',
            'steps' => 'required|integer|min:20|max:50',
        ];
    }
}
