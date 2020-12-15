<?php
/**
 * File
 * php version 7.4.5
 *
 * Description of what this module (or file) is doing.
 *
 * @category Package
 * @package  Socialite_Extend
 * @author   Rifqi Saiful A.H <rifqi_sah@yahoo.com>
 * @license  https://mit-license.org/ MIT
 * @link     https://packagist.org/packages/rifqisah/twittertwo
 */
namespace rifqisah\twittertwo;

use SocialiteProviders\Manager\OAuth1\AbstractProvider;
use SocialiteProviders\Manager\OAuth1\User;

/**
 * * TwitterTwoExtendSocialite
 *
 * @category Class
 * @package  Socialite_Extend
 * @author   Rifqi Saiful A.H <rifqi_sah@yahoo.com>
 * @license  https://mit-license.org/ MIT
 * @link     https://packagist.org/packages/rifqisah/twittertwo
 */
class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'TWITTERTWO';

    /**
     * Map User to Object.
     *
     * @param array $user the user array
     *
     * @return string
     * */
    protected function mapUserToObject(array $user)
    {
        return
        (new User())->setRaw($user['extra'])->map(
            [
                'id'       => $user['id'],
                'nickname' => $user['nickname'],
                'name'     => $user['name'],
                'email'    => $user['email'],
                'avatar'   => $user['avatar'],
            ]
        );
    }
}
