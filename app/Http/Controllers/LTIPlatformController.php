<?php

namespace App\Http\Controllers;

use App\Models\LTIPlatform;
use Illuminate\Http\Request;

class LTIPlatformController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->authorizeResource(LTIPlatform::class, 'ltiplatform');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lti_platform.index', ['lti_platforms' => LTIPlatform::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header = $title = __('Create LTI Platform');
        return view('admin.lti_platform.edit', [
            'header' => $header,
            'title' => $title,
            'verb' => 'store',
            'platform' => new LTIPlatform,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate & Save
        $validated = $request->validate([
            'domain' => 'required',
            'clientId' => 'required',
            'authLoginURL' => 'required|url',
            'authTokenURL' => 'required|url',
            'keySetURL' => 'required|url',
            'privateKey' => 'required',
            'jsonDeploymentString' => 'required',
            'lineItemsURL' => 'required|url',
            'scopeURLs' => 'required',
            'apiToken' => 'required',
            'apiSecret' => 'required',
            'apiEndpoint' => 'required',
        ]);

        $platform = LTIPlatform::create([
            'domain' => $request->domain,
            'client_id' => $request->clientId,
            'auth_login_url' => $request->authLoginURL,
            'auth_token_url' => $request->authTokenURL,
            'key_set_url' => $request->keySetURL,
            'private_key' => $request->privateKey,
            'deployment_json' => $request->jsonDeploymentString,
            'line_items_url' => $request->lineItemsURL,
            'scope_urls' => $request->scopeURLs,
            'api_token' => $request->apiToken,
            'api_secret' => $request->apiSecret,
            'api_endpoint' => $request->apiEndpoint,
        ]);

        return redirect(route('admin.ltiplatforms.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LTIPlatform  $lTIPlatform
     * @return \Illuminate\Http\Response
     */
    public function show(LTIPlatform $ltiplatform)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LTIPlatform  $lTIPlatform
     * @return \Illuminate\Http\Response
     */
    public function edit(LTIPlatform $ltiplatform)
    {
        $header = $title = __('Edit LTI Platform');
        return view('admin.lti_platform.edit', [
            'header' => $header,
            'title' => $title,
            'verb' => 'update',
            'platform' => $ltiplatform,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LTIPlatform  $lTIPlatform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LTIPlatform $ltiplatform)
    {
        // Validate & Save
        $validated = $request->validate([
            'domain' => 'required',
            'clientId' => 'required',
            'authLoginURL' => 'required|url',
            'authTokenURL' => 'required|url',
            'keySetURL' => 'required|url',
            'privateKey' => 'required',
            'jsonDeploymentString' => 'required',
            'lineItemsURL' => 'required|url',
            'scopeURLs' => 'required',
            'apiToken' => 'required',
            'apiSecret' => 'required',
            'apiEndpoint' => 'required',
        ]);

        $ltiplatform->fill([
            'domain' => $request->domain,
            'client_id' => $request->clientId,
            'auth_login_url' => $request->authLoginURL,
            'auth_token_url' => $request->authTokenURL,
            'key_set_url' => $request->keySetURL,
            'private_key' => $request->privateKey,
            'deployment_json' => $request->jsonDeploymentString,
            'line_items_url' => $request->lineItemsURL,
            'scope_urls' => $request->scopeURLs,
            'api_token' => $request->apiToken,
            'api_secret' => $request->apiSecret,
            'api_endpoint' => $request->apiEndpoint,
        ]);
        $ltiplatform->save();

        return redirect(route('admin.ltiplatforms.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LTIPlatform  $lTIPlatform
     * @return \Illuminate\Http\Response
     */
    public function destroy(LTIPlatform $ltiplatform)
    {
        $ltiplatform->delete();
        return redirect(route('admin.ltiplatforms.index'));
    }
}
