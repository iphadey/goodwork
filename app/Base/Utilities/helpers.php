<?php

use Illuminate\Support\Str;

if (! function_exists('application_last_updated')) {
    /**
     * Return the date when the application was last updated.
     *
     * @return string
     */
    function application_last_updated()
    {
        return date('F d Y', filemtime(base_path() . '/config/app.php'));
    }
}

if (! function_exists('get_locale')) {
    /**
     * Get user set locale or default locale.
     *
     * @return string
     */
    function get_locale(): ?string
    {
        $user = auth()->user();

        return $user->lang ?? 'en';
    }
}

if (! function_exists('localize')) {
    /**
     * Translate the given message.
     *
     * @param  string                                                         $key
     * @param  array                                                          $replace
     * @param  string                                                         $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function localize($key = null, $replace = [], $locale = null)
    {
        $result = trans($key, $replace, $locale);

        if ($result === $key) {
            preg_match('/^.+\.(.+)/', $key, $matches);

            return $matches[1];
        }

        return $result;
    }
}

if (! function_exists('trim_last_dot')) {
    /**
     * Remove any trailing dot (".") character.
     *
     * @param  string $text
     * @return string
     */
    function trim_last_dot($text)
    {
        return substr_replace($text, '', -1);
    }
}

if (! function_exists('is_admin_route')) {
    /**
     * Check if current route is an admin route.
     *
     * @return bool
     */
    function is_admin_route()
    {
        return request()->segment(1) === 'admin';
    }
}

if (! function_exists('is_single_resource_route')) {
    /**
     * Check if current route shows a single Project/Team/Office.
     *
     * @return bool
     */
    function is_single_resource_route()
    {
        return in_array(
            request()->segment(1),
            ['projects', 'teams', 'offices']
        );
    }
}

if (! function_exists('user')) {
    /**
     * Get current authenticated user.
     *
     * @return \App\Base\Models\User
     */
    function user()
    {
        return auth()->user();
    }
}

if (! function_exists('str_limit')) {
    function str_limit(string $text, int $length = 75): string
    {
        return Str::limit($text, $length);
    }
}

if (! function_exists('plugins_path')) {
    /**
     * Get absolute path to plugins directory.
     *
     * @param  string $path
     * @return string
     */
    function plugins_path(string $path = null): string
    {
        return $path ? base_path('plugins' . '/' . $path) : base_path('plugins');
    }
}

if (! function_exists('available_languages')) {
    /**
     * Get the available languages for this application.
     *
     * @param  string $path
     * @return string
     */
    function available_languages($key = null)
    {
        $default = [
            'en' => 'English',
        ];

        $languages = collect([
            'af'     => 'Afrikaans',
            'af-ZA'  => 'Afrikaans (South Africa)',
            'ar'     => 'Arabic',
            'ar-AE'  => 'Arabic (U.A.E.)',
            'ar-BH'  => 'Arabic (Bahrain)',
            'ar-DZ'  => 'Arabic (Algeria)',
            'ar-EG'  => 'Arabic (Egypt)',
            'ar-IQ'  => 'Arabic (Iraq)',
            'ar-JO'  => 'Arabic (Jordan)',
            'ar-KW'  => 'Arabic (Kuwait)',
            'ar-LB'  => 'Arabic (Lebanon)',
            'ar-LY'  => 'Arabic (Libya)',
            'ar-MA'  => 'Arabic (Morocco)',
            'ar-OM'  => 'Arabic (Oman)',
            'ar-QA'  => 'Arabic (Qatar)',
            'ar-SA'  => 'Arabic (Saudi Arabia)',
            'ar-SY'  => 'Arabic (Syria)',
            'ar-TN'  => 'Arabic (Tunisia)',
            'ar-YE'  => 'Arabic (Yemen)',
            'az'     => 'Azeri (Latin)',
            'az-AZ'  => 'Azeri (Latin) (Azerbaijan)',
            'az-AZ'  => 'Azeri (Cyrillic) (Azerbaijan)',
            'be'     => 'Belarusian',
            'be-BY'  => 'Belarusian (Belarus)',
            'bg'     => 'Bulgarian',
            'bg-BG'  => 'Bulgarian (Bulgaria)',
            'bs-BA'  => 'Bosnian (Bosnia and Herzegovina)',
            'ca'     => 'Catalan',
            'ca-ES'  => 'Catalan (Spain)',
            'cs'     => 'Czech',
            'cs-CZ'  => 'Czech (Czech Republic)',
            'cy'     => 'Welsh',
            'cy-GB'  => 'Welsh (United Kingdom)',
            'da'     => 'Danish',
            'da-DK'  => 'Danish (Denmark)',
            'de'     => 'German',
            'de-AT'  => 'German (Austria)',
            'de-CH'  => 'German (Switzerland)',
            'de-DE'  => 'German (Germany)',
            'de-LI'  => 'German (Liechtenstein)',
            'de-LU'  => 'German (Luxembourg)',
            'dv'     => 'Divehi',
            'dv-MV'  => 'Divehi (Maldives)',
            'el'     => 'Greek',
            'el-GR'  => 'Greek (Greece)',
            'en'     => 'English',
            'en-AU'  => 'English (Australia)',
            'en-BZ'  => 'English (Belize)',
            'en-CA'  => 'English (Canada)',
            'en-CB'  => 'English (Caribbean)',
            'en-GB'  => 'English (United Kingdom)',
            'en-IE'  => 'English (Ireland)',
            'en-JM'  => 'English (Jamaica)',
            'en-NZ'  => 'English (New Zealand)',
            'en-PH'  => 'English (Republic of the Philippines)',
            'en-TT'  => 'English (Trinidad and Tobago)',
            'en-US'  => 'English (United States)',
            'en-ZA'  => 'English (South Africa)',
            'en-ZW'  => 'English (Zimbabwe)',
            'eo'     => 'Esperanto',
            'es'     => 'Spanish',
            'es-AR'  => 'Spanish (Argentina)',
            'es-BO'  => 'Spanish (Bolivia)',
            'es-CL'  => 'Spanish (Chile)',
            'es-CO'  => 'Spanish (Colombia)',
            'es-CR'  => 'Spanish (Costa Rica)',
            'es-DO'  => 'Spanish (Dominican Republic)',
            'es-EC'  => 'Spanish (Ecuador)',
            'es-ES'  => 'Spanish (Castilian)',
            'es-ES'  => 'Spanish (Spain)',
            'es-GT'  => 'Spanish (Guatemala)',
            'es-HN'  => 'Spanish (Honduras)',
            'es-MX'  => 'Spanish (Mexico)',
            'es-NI'  => 'Spanish (Nicaragua)',
            'es-PA'  => 'Spanish (Panama)',
            'es-PE'  => 'Spanish (Peru)',
            'es-PR'  => 'Spanish (Puerto Rico)',
            'es-PY'  => 'Spanish (Paraguay)',
            'es-SV'  => 'Spanish (El Salvador)',
            'es-UY'  => 'Spanish (Uruguay)',
            'es-VE'  => 'Spanish (Venezuela)',
            'et'     => 'Estonian',
            'et-EE'  => 'Estonian (Estonia)',
            'eu'     => 'Basque',
            'eu-ES'  => 'Basque (Spain)',
            'fa'     => 'Farsi',
            'fa-IR'  => 'Farsi (Iran)',
            'fi'     => 'Finnish',
            'fi-FI'  => 'Finnish (Finland)',
            'fo'     => 'Faroese',
            'fo-FO'  => 'Faroese (Faroe Islands)',
            'fr'     => 'French',
            'fr-BE'  => 'French (Belgium)',
            'fr-CA'  => 'French (Canada)',
            'fr-CH'  => 'French (Switzerland)',
            'fr-FR'  => 'French (France)',
            'fr-LU'  => 'French (Luxembourg)',
            'fr-MC'  => 'French (Principality of Monaco)',
            'gl'     => 'Galician',
            'gl-ES'  => 'Galician (Spain)',
            'gu'     => 'Gujarati',
            'gu-IN'  => 'Gujarati (India)',
            'he'     => 'Hebrew',
            'he-IL'  => 'Hebrew (Israel)',
            'hi'     => 'Hindi',
            'hi-IN'  => 'Hindi (India)',
            'hr'     => 'Croatian',
            'hr-BA'  => 'Croatian (Bosnia and Herzegovina)',
            'hr-HR'  => 'Croatian (Croatia)',
            'hu'     => 'Hungarian',
            'hu-HU'  => 'Hungarian (Hungary)',
            'hy'     => 'Armenian',
            'hy-AM'  => 'Armenian (Armenia)',
            'id'     => 'Indonesian',
            'id-ID'  => 'Indonesian (Indonesia)',
            'is'     => 'Icelandic',
            'is-IS'  => 'Icelandic (Iceland)',
            'it'     => 'Italian',
            'it-CH'  => 'Italian (Switzerland)',
            'it-IT'  => 'Italian (Italy)',
            'ja'     => 'Japanese',
            'ja-JP'  => 'Japanese (Japan)',
            'ka'     => 'Georgian',
            'ka-GE'  => 'Georgian (Georgia)',
            'kk'     => 'Kazakh',
            'kk-KZ'  => 'Kazakh (Kazakhstan)',
            'kn'     => 'Kannada',
            'kn-IN'  => 'Kannada (India)',
            'ko'     => 'Korean',
            'ko-KR'  => 'Korean (Korea)',
            'kok'    => 'Konkani',
            'kok-IN' => 'Konkani (India)',
            'ky'     => 'Kyrgyz',
            'ky-KG'  => 'Kyrgyz (Kyrgyzstan)',
            'lt'     => 'Lithuanian',
            'lt-LT'  => 'Lithuanian (Lithuania)',
            'lv'     => 'Latvian',
            'lv-LV'  => 'Latvian (Latvia)',
            'mi'     => 'Maori',
            'mi-NZ'  => 'Maori (New Zealand)',
            'mk'     => 'FYRO Macedonian',
            'mk-MK'  => 'FYRO Macedonian (Former Yugoslav Republic of Macedonia)',
            'mn'     => 'Mongolian',
            'mn-MN'  => 'Mongolian (Mongolia)',
            'mr'     => 'Marathi',
            'mr-IN'  => 'Marathi (India)',
            'ms'     => 'Malay',
            'ms-BN'  => 'Malay (Brunei Darussalam)',
            'ms-MY'  => 'Malay (Malaysia)',
            'mt'     => 'Maltese',
            'mt-MT'  => 'Maltese (Malta)',
            'nb'     => 'Norwegian (Bokm?l)',
            'nb-NO'  => 'Norwegian (Bokm?l) (Norway)',
            'nl'     => 'Dutch',
            'nl-BE'  => 'Dutch (Belgium)',
            'nl-NL'  => 'Dutch (Netherlands)',
            'nn-NO'  => 'Norwegian (Nynorsk) (Norway)',
            'ns'     => 'Northern Sotho',
            'ns-ZA'  => 'Northern Sotho (South Africa)',
            'pa'     => 'Punjabi',
            'pa-IN'  => 'Punjabi (India)',
            'pl'     => 'Polish',
            'pl-PL'  => 'Polish (Poland)',
            'ps'     => 'Pashto',
            'ps-AR'  => 'Pashto (Afghanistan)',
            'pt'     => 'Portuguese',
            'pt-BR'  => 'Portuguese (Brazil)',
            'pt-PT'  => 'Portuguese (Portugal)',
            'qu'     => 'Quechua',
            'qu-BO'  => 'Quechua (Bolivia)',
            'qu-EC'  => 'Quechua (Ecuador)',
            'qu-PE'  => 'Quechua (Peru)',
            'ro'     => 'Romanian',
            'ro-RO'  => 'Romanian (Romania)',
            'ru'     => 'Russian',
            'ru-RU'  => 'Russian (Russia)',
            'sa'     => 'Sanskrit',
            'sa-IN'  => 'Sanskrit (India)',
            'se'     => 'Sami (Northern)',
            'se-FI'  => 'Sami (Northern) (Finland)',
            'se-FI'  => 'Sami (Skolt) (Finland)',
            'se-FI'  => 'Sami (Inari) (Finland)',
            'se-NO'  => 'Sami (Northern) (Norway)',
            'se-NO'  => 'Sami (Lule) (Norway)',
            'se-NO'  => 'Sami (Southern) (Norway)',
            'se-SE'  => 'Sami (Northern) (Sweden)',
            'se-SE'  => 'Sami (Lule) (Sweden)',
            'se-SE'  => 'Sami (Southern) (Sweden)',
            'sk'     => 'Slovak',
            'sk-SK'  => 'Slovak (Slovakia)',
            'sl'     => 'Slovenian',
            'sl-SI'  => 'Slovenian (Slovenia)',
            'sq'     => 'Albanian',
            'sq-AL'  => 'Albanian (Albania)',
            'sr-BA'  => 'Serbian (Latin) (Bosnia and Herzegovina)',
            'sr-BA'  => 'Serbian (Cyrillic) (Bosnia and Herzegovina)',
            'sr-SP'  => 'Serbian (Latin) (Serbia and Montenegro)',
            'sr-SP'  => 'Serbian (Cyrillic) (Serbia and Montenegro)',
            'sv'     => 'Swedish',
            'sv-FI'  => 'Swedish (Finland)',
            'sv-SE'  => 'Swedish (Sweden)',
            'sw'     => 'Swahili',
            'sw-KE'  => 'Swahili (Kenya)',
            'syr'    => 'Syriac',
            'syr-SY' => 'Syriac (Syria)',
            'ta'     => 'Tamil',
            'ta-IN'  => 'Tamil (India)',
            'te'     => 'Telugu',
            'te-IN'  => 'Telugu (India)',
            'th'     => 'Thai',
            'th-TH'  => 'Thai (Thailand)',
            'tl'     => 'Tagalog',
            'tl-PH'  => 'Tagalog (Philippines)',
            'tn'     => 'Tswana',
            'tn-ZA'  => 'Tswana (South Africa)',
            'tr'     => 'Turkish',
            'tr-TR'  => 'Turkish (Turkey)',
            'tt'     => 'Tatar',
            'tt-RU'  => 'Tatar (Russia)',
            'ts'     => 'Tsonga',
            'uk'     => 'Ukrainian',
            'uk-UA'  => 'Ukrainian (Ukraine)',
            'ur'     => 'Urdu',
            'ur-PK'  => 'Urdu (Islamic Republic of Pakistan)',
            'uz'     => 'Uzbek (Latin)',
            'uz-UZ'  => 'Uzbek (Latin) (Uzbekistan)',
            'uz-UZ'  => 'Uzbek (Cyrillic) (Uzbekistan)',
            'vi'     => 'Vietnamese',
            'vi-VN'  => 'Vietnamese (Viet Nam)',
            'xh'     => 'Xhosa',
            'xh-ZA'  => 'Xhosa (South Africa)',
            'zh'     => 'Chinese',
            'zh-CN'  => 'Chinese (Simplified)',
            'zh-HK'  => 'Chinese (Hong Kong)',
            'zh-MO'  => 'Chinese (Macau)',
            'zh-SG'  => 'Chinese (Singapore)',
            'zh-TW'  => 'Chinese (T)',
            'zu'     => 'Zulu',
            'zu-ZA'  => 'Zulu (South Africa)'
        ]);

        if ($key && $languages->has($key) ) {
            return $languages->get($key);
        }

        $enabled = config('app.enabled_languages');

        if (empty($enabled)) {
            return $default;
        }

        $results = [];

        $enables = explode(',', $enabled);

        foreach ($enables as $lang) {
            if (Lang::has('home.Home', $lang) && $languages->has($lang)) {
                $results[$lang] = $languages->get($lang);
            }
        }

        if (empty($results)) {
            return $default;
        }

        return $results;
    }
}