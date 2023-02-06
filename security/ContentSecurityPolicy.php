<?php


use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Policy;

class ContentSecurityPolicy extends Policy
{
    public function configure()
    {
        // Used spatie/laravel-csp package
        // Base policies
        $this
            ->addDirective(Directive::BASE, Keyword::SELF)
            ->addDirective(Directive::CONNECT, Keyword::SELF)
            ->addDirective(Directive::DEFAULT, Keyword::SELF)
            ->addDirective(Directive::FORM_ACTION, Keyword::SELF)
            ->addDirective(Directive::IMG, Keyword::SELF)
            ->addDirective(Directive::MEDIA, Keyword::SELF)
            ->addDirective(Directive::OBJECT, Keyword::NONE)
            ->addDirective(Directive::SCRIPT, Keyword::SELF)
            ->addDirective(Directive::STYLE, Keyword::SELF)
            ->addNonceForDirective(Directive::SCRIPT)
            ->addNonceForDirective(Directive::STYLE);

        // Custom policies
        $this
            ->addGeneralDirectives()
            ->addDirectivesForGoogleFonts()
            ->addDirectivesForGoogleTagManager()
            ->addDirectivesForGoogleAnalytics()
            ->addDirectivesForGoogleApis()
            ->addDirectivesForCookieBot()
            ->addDirectivesForAWS()
            ->addDirectivesForUnpkg()
            ->addDirectivesForCloudflare();
    }

    protected function addGeneralDirectives(): self
    {
        return $this
            ->addDirective(Directive::STYLE, [
                'data:',
            ])
            ->addDirective(Directive::IMG, [
                'data:'
            ])
            ->addDirective(Directive::FONT, [
                'data:'
            ]);
    }

    protected function addDirectivesForGoogleFonts(): self
    {
        return $this
            ->addDirective(Directive::FONT, 'fonts.gstatic.com')
            ->addDirective(Directive::STYLE, 'fonts.googleapis.com');
    }

    protected function addDirectivesForGoogleTagManager(): self
    {
        return $this->addDirective(Directive::SCRIPT, '*.googletagmanager.com');
    }

    protected function addDirectivesForGoogleAnalytics(): self
    {
        return $this->addDirective(Directive::CONNECT, '*.google-analytics.com');
    }

    protected function addDirectivesForGoogleApis(): self
    {
        return $this
            ->addDirective(Directive::SCRIPT, '*.googleapis.com')
            ->addDirective(Directive::CONNECT, '*.googleapis.com');
    }

    protected function addDirectivesForCookieBot(): self
    {
        return $this
            ->addDirective(Directive::SCRIPT, 'https://consent.cookiebot.com/')
            ->addDirective(Directive::FRAME, 'https://consentcdn.cookiebot.com/');
    }

    protected function addDirectivesForUnpkg(): self
    {
        return $this
            ->addDirective(Directive::SCRIPT, 'https://unpkg.com/')
            ->addDirective(Directive::STYLE, 'https://unpkg.com/');
    }

    protected function addDirectivesForCloudflare(): self
    {
        return $this->addDirective(Directive::SCRIPT, 'https://cdnjs.cloudflare.com/');
    }
}
