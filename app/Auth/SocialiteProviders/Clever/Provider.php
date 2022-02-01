<?php

namespace App\Auth\SocialiteProviders\Clever;

use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'CLEVER';

    /**
     * Base URL
     */
    const URL = 'https://api.clever.com';

    /**
     * {@inheritdoc}
     */
    protected $scopes = [''];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://clever.com/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://clever.com/oauth/tokens';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $headers = [ 'headers' => [
                'Authorization' => "Bearer {$token}",
            ],
        ];
        $user_response = $this->getHttpClient()->get($this::URL . '/v3.0/me', $headers);
        $user = json_decode($user_response->getBody(), true);

        $response = $this->getHttpClient()->get($this::URL . $user['links'][1]['uri'], $headers);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        // Teacher object data includes:
        //   * Clever ID
        //   * Name (first, middle, last)
        //   * Email
        // Student object data includes:
        //   * Clever ID
        //   * Name (first, last initial)
        //   * Grade (if available form the SIS)
        //
        // From https://dev.clever.com/docs/classroom-with-oauth
        return (new User())->setRaw($user)->map([
            'id'        => $user['data']['id'],
            'name'      => $user['data']['email'],
            'full_name' => "{$user['data']['name']['first']} {$user['data']['name']['last']}",
            'email'     => $user['data']['email'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code'
        ]);
    }

    /**
     * Get the access token for the given code.
     *
     * @param  string  $code
     * @return string
     */
    public function getAccessToken($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'auth' => [$this->clientId, $this->clientSecret],
            'headers' => ['Accept' => 'application/json'],
            'form_params' => $this->getTokenFields($code),
        ]);

        return json_decode($response->getBody(), true)['access_token'];
    }
}
