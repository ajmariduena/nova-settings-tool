<?php

namespace Ajmariduena\SettingsTool\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class SettingsToolController extends Controller
{
    /** @var string */
    protected $settingsPath;
    protected $disk;

    public function __construct(string $settingsPath = null)
    {
        $this->settingsPath = $settingsPath ?? storage_path(config('settings.path', 'app/settings.json'));
        $this->disk = $settingsPath ?? config('settings.disk', 'public');
    }

    public function read(Request $request)
    {
        $settings = Valuestore::make($this->settingsPath)->all();

        $settingConfig = config('settings.panels');

        foreach ($settingConfig as $object) {
            foreach ($object['settings'] as $settingObject) {
                if (!array_key_exists($settingObject['key'], $settings)) {
                    $settings[$settingObject['key']] = $settingObject['type'] == 'toggle' ? false : '';
                }
            }
        }

        return response()->json([
            'settings' => $settings,
            'settingConfig' => $settingConfig,
        ]);
    }

    public function write(Request $request)
    {
        $data = $request->all();
        $settings = Valuestore::make($this->settingsPath);

        foreach ($data as $setting => $value) {
            if ($request->hasFile($setting)) {
                // Handle this as file
                $fileName = $request->file($setting)->getClientOriginalName();
                $filePath = $request->file($setting)->storeAs('settings', $fileName, $this->disk);

                $settings->put($setting, Storage::url($filePath));
            } else {
                if ($value === 'null') {
                    $value = null;
                }
                $settings->put($setting, $value);
            }
        }

        return response($settings->all(), 202);
    }
}
