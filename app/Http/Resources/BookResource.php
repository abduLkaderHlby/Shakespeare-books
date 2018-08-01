<?php
/**
 * Created by PhpStorm.
 * User: abdulkaderalhalaby
 * Date: 7/28/18
 * Time: 4:37 PM
 */

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\Resource;

class BookResource extends Resource
{
    public function toArray($request)
    {
        return [
            'play_name' => $this['play_name'],
            'text' => $this['text_entry']
        ];
    }
}