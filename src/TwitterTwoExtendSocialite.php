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

use SocialiteProviders\Manager\SocialiteWasCalled;

/**
 * * TwitterTwoExtendSocialite
 *
 * @category Package
 * @package  Socialite
 * @author   Rifqi Saiful A.H <rifqi_sah@yahoo.com>
 * @license  https://mit-license.org/ MIT
 * @link     https://packagist.org/packages/rifqisah/twittertwo
 */
class TwitterTwoExtendSocialite
{
    /**
     * Execute the provider.

     * @param SocialiteWasCalled $socialiteWasCalled Handler when socialite is called
     *
     * @return void
     * */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'twittertwo',
            __NAMESPACE__.'\Provider',
            __NAMESPACE__.'\Server'
        );
    }
}
