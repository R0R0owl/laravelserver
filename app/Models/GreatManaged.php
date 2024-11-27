<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class GreatManaged extends Model
{
    use HasFactory;

    protected $table = 'greatmanaged';

    protected $fillable =['name', 'year', 'lastyear'];

        /**
     * バリデーション
     */
    public static function rules()
    {
        return [
                'name' => 'required|string|max:255',
                'year' => 'required|integer|min:0',
                'lastyear' => 'required|integer|min:0|gte:year',
        ];
    }

    //エラーメッセージ
    public static function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'year.required' => '出生年は必須です。',
            'year.integer' => '出生年は数値でなければなりません。',
            'lastyear.gte' => '亡年は出生年以降でなければなりません。',
        ];
    }
}
