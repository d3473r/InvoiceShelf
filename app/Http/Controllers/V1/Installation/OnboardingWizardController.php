<?php

namespace InvoiceShelf\Http\Controllers\V1\Installation;

use Illuminate\Http\Request;
use InvoiceShelf\Http\Controllers\Controller;
use InvoiceShelf\Models\Setting;

class OnboardingWizardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStep(Request $request)
    {
        if (! \Storage::disk('local')->has('database_created')) {
            return response()->json([
                'profile_complete' => 0,
            ]);
        }

        return response()->json([
            'profile_complete' => Setting::getSetting('profile_complete'),
        ]);
    }

    public function updateStep(Request $request)
    {
        $setting = Setting::getSetting('profile_complete');

        if ($setting === 'COMPLETED') {
            return response()->json([
                'profile_complete' => $setting,
            ]);
        }

        Setting::setSetting('profile_complete', $request->profile_complete);

        return response()->json([
            'profile_complete' => Setting::getSetting('profile_complete'),
        ]);
    }
}
