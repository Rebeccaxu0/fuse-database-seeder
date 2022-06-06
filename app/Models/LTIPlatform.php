<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LTIPlatform extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'domain',
        'client_id',
        'auth_login_url',
        'auth_token_url',
        'key_set_url',
        'private_key',
        'deployment_json',
        'line_items_url',
        'scope_urls',
        'api_token',
        'api_secret',
        'api_endpoint',
    ];
}
