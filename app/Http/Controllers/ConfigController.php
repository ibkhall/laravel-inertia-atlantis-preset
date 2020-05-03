<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ConfigController extends Controller
{

    /**
     * @param Request $request
     * @return Response|ResponseFactory
     */
    public function system(Request $request) {
        $config = Config::first();

        if($request->getMethod() === 'POST') {
            $config->update($request->all());
            if($request->toggle_sidebar) {
                return back();
            }
            return back()->with('success', 'Opération effectuée !');
        }
        return inertia('Configurations/System', [
            'config' => $config,
            'title' => 'Configuration du système'
        ]);
    }
}
