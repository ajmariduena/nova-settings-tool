<?php

use Spatie\Valuestore\Valuestore;

function settings($key = null, $default = null)
{
    $settingsPath = storage_path(config('settings.path', 'app/settings.json'));

    $settings = Valuestore::make($settingsPath);

    if ($key === null) {
        return $settings->all();
    }

    return $settings->get($key, $default);
}
