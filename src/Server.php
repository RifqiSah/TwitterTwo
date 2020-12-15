<?php
/**
 * File
 * php version 7.4.5
 *
 * Description of what this module (or file) is doing.
 *
 * @category Package
 * @package  Socialite
 * @author   Rifqi Saiful A.H <rifqi_sah@yahoo.com>
 * @license  https://mit-license.org/ MIT
 * @link     https://packagist.org/packages/rifqisah/twittertwo
 */
namespace rifqisah\twittertwo;

use League\OAuth1\Client\Credentials\TemporaryCredentials;
use League\OAuth1\Client\Credentials\TokenCredentials;
use SocialiteProviders\Manager\OAuth1\Server as BaseServer;
use SocialiteProviders\Manager\OAuth1\User;

/**
 * * TwitterTwoExtendSocialite
 *
 * @category Class
 * @package  Socialite
 * @author   Rifqi Saiful A.H <rifqi_sah@yahoo.com>
 * @license  https://mit-license.org/ MIT
 * @link     https://packagist.org/packages/rifqisah/twittertwo
 */
class Server extends BaseServer
{
    /**
     * Execute the provider.

     * @return string
     * */
    public function urlTemporaryCredentials()
    {
        return 'https://api.twitter.com/oauth/request_token';
    }

    /**
     * Execute the provider.

     * @return string
     * */
    public function urlAuthorization()
    {
        return 'https://api.twitter.com/oauth/authenticate';
    }

    /**
     * Execute the provider.

     * @return string
     * */
    public function urlTokenCredentials()
    {
        return 'https://api.twitter.com/oauth/access_token';
    }

    /**
     * Execute the provider.

     * @return string
     * */
    public function urlUserDetails()
    {
        return 'https://api.twitter.com/1.1/account/verify_credentials.json?include_email=true';
    }

    /**
     * Execute the provider.

     * @param array           $data             the data array
     * @param TokenCredential $tokenCredentials the data array
     *
     * @return User
     * */
    public function userDetails($data, TokenCredentials $tokenCredentials)
    {
        $user = new User();
        $user->id = $data['id'];
        $user->nickname = $data['screen_name'];
        $user->name = $data['name'];
        $user->location = $data['location'];
        $user->description = $data['description'];
        $user->avatar = $data['profile_image_url'];
        $user->email = null;

        if (isset($data['email'])) {
            $user->email = $data['email'];
        }

        $used = ['id', 'screen_name', 'name', 'location', 'description', 'profile_image_url', 'email'];

        foreach ($data as $key => $value) {
            if (strpos($key, 'url') !== false) {
                if (!in_array($key, $used)) {
                    $used[] = $key;
                }

                $user->urls[$key] = $value;
            }
        }

        $user->extra = array_diff_key($data, array_flip($used));

        return $user;
    }

    /**
     * Execute the provider.

     * @param array           $data             the data array
     * @param TokenCredential $tokenCredentials the data array
     *
     * @return string
     * */
    public function userUid($data, TokenCredentials $tokenCredentials)
    {
        return $data['id'];
    }

    /**
     * Execute the provider.

     * @param array           $data             the data array
     * @param TokenCredential $tokenCredentials the data array
     *
     * @return string
     * */
    public function userEmail($data, TokenCredentials $tokenCredentials)
    {
    }
    /**
     * Execute the provider.

     * @param array           $data             the data array
     * @param TokenCredential $tokenCredentials the data array
     *
     * @return string
     * */
    public function userScreenName($data, TokenCredentials $tokenCredentials)
    {
        return $data['screen_name'];
    }

    /**
     * Execute the provider.

     * @param array $temporaryIdentifier the data array
     *
     * @return string
     * */
    public function getAuthorizationUrl($temporaryIdentifier)
    {
        // Somebody can pass through an instance of temporary
        // credentials and we'll extract the identifier from there.
        if ($temporaryIdentifier instanceof TemporaryCredentials) {
            $temporaryIdentifier = $temporaryIdentifier->getIdentifier();
        }
        $query_oauth_token = ['oauth_token' => $temporaryIdentifier];
        $parameters = (isset($this->parameters))
            ? array_merge($query_oauth_token, $this->parameters)
            : $query_oauth_token;

        $url = $this->urlAuthorization();
        $queryString = http_build_query($parameters);

        return $this->buildUrl($url, $queryString);
    }
}
