# Multilanguage Support

o5CMS supports multilingual websites, but this feature is **disabled by default**.

## Enabling Multilanguage

To enable multilingual support, update your `.env` file with the following parameters:

```dotenv
APP_LOCALE=en
APP_MULTILANG=true
APP_LOCALES=en,ru
```

## Explanation:

    + APP_LOCALE — Default locale
    + APP_MULTILANG — Enables or disables multilingual functionality.
        + false (default): Multilanguage is disabled.
        + true: Multilanguage is enabled.

    + APP_LOCALES — Comma-separated list of supported languages (e.g. en,ru).
        + Do not put commas at the beginning or end of the list.

## 📁 Language Files

Each language must have its own translation folder in resources/lang/.

Example structure:
resources/
└── lang/
    ├── en/
    │   └── messages.php
    └── ru/
        └── messages.php

Sample translation file: resources/lang/en/messages.php
return [
    'welcome' => 'Welcome!',
];

Usage in Blade templates:
{{ __('messages.welcome') }}

## 🌐 URL Structure

When multilingual mode is enabled, the language is determined by the first URL segment:
/en → English version
/ru → Russian version