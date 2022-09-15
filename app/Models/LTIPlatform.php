<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\LTIPlatform
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $domain
 * @property string $client_id
 * @property string $auth_login_url
 * @property string $auth_token_url
 * @property string $key_set_url
 * @property string $private_key
 * @property string $deployment_json
 * @property string $line_items_url
 * @property string $scope_urls
 * @property string|null $api_token
 * @property string|null $api_secret
 * @property string|null $api_endpoint
 * @property int|null $d7_id
 * @method static \Database\Factories\LTIPlatformFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform newQuery()
 * @method static \Illuminate\Database\Query\Builder|LTIPlatform onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform query()
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereApiEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereApiSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereAuthLoginUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereAuthTokenUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereDeploymentJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereKeySetUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereLineItemsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform wherePrivateKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereScopeUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LTIPlatform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LTIPlatform withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LTIPlatform withoutTrashed()
 * @mixin \Eloquent
 */
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
