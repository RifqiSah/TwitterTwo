<?php

namespace rifqiSah\twitterTwo;

use SocialiteProviders\Manager\SocialiteWasCalled;

class TwitterTwoExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'twittertwo', __NAMESPACE__.'\Provider', __NAMESPACE__.'\Server'
        );
    }
}
