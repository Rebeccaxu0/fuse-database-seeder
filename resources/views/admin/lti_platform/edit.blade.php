<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="header">{{ $header }}</x-slot>

    @if (isset($platform->id))
    <form action="{{ route('admin.ltiplatforms.destroy', $platform) }}" method="POST">
        @method('DELETE')
        @csrf
        <button class="float-right bg-red-500">Delete Platform</button>
    </form>
    @endif

    <form class="mt-6" action="{{ route("admin.ltiplatforms.{$verb}", $platform) }}" method="POST">
        @if (isset($platform->id))
            @method('PATCH')
        @endif
        @csrf
        <x-form.input label="Platform Domain"
                      name="domain"
                      required="true"
                      placeholder="l3.examplelms.org"
                      :value="old('domain', $platform->domain)" />
        <x-form.input label="Client ID"
                      name="clientId"
                      placeholder="Test"
                      required="true"
                      :value="old('clientId', $platform->client_id)" />
        <x-form.input label="Authentication Login URL"
                      name="authLoginURL"
                      placeholder="https://qa.cityoflearning.me/lti-auth"
                      required="true"
                      :value="old('authLoginURL', $platform->auth_login_url)" />
        <x-form.input label="Authentication Token URL"
                      name="authTokenURL"
                      placeholder="http://evanston.col-engine-qa.com/api/v1/lti_tool_providers/2/auth.json"
                      required="true"
                      :value="old('authTokenURL', $platform->auth_token_url)" />
        <x-form.input label="Key Set URL"
                      name="keySetURL"
                      placeholder="https://qa.cityoflearning.me/packages/l3lti/assets/jwks.json"
                      required="true"
                      :value="old('keySetURL', $platform->key_set_url)" />
        <x-form.textarea label="Private Key"
                      name="privateKey"
                      placeholder="Contents of RSA private key file"
                      required="true"
                      :value="old('privateKey', $platform->private_key)" />
        <x-form.input label="Deployment String (JSON)"
                      name="jsonDeploymentString"
                      placeholder="{'1234' : '1234'}"
                      required="true"
                      :value="old('jsonDeploymentString', $platform->deployment_json)" />
        <x-form.input label="Line Items URL"
                      name="lineItemsURL"
                      placeholder="http://evanston.col-engine-qa.com/api/v1/lti_line_items"
                      required="true"
                      :value="old('lineItemsURL', $platform->line_items_url)" />
        <x-form.input label="Scope URLs"
                      name="scopeURLs"
                      placeholder="['https://purl.imsglobal.org/spec/lti-ags/scope/lineitem', 'https://purl.imsglobal.org/spec/lti-ags/scope/result.readonly', 'https://purl.imsglobal.org/spec/lti-ags/scope/score']"
                      required="true"
                      :value="old('scopeURLs', $platform->scope_urls)" />
        <x-form.input label="API Token"
                      name="apiToken"
                      required="true"
                      :value="old('apiToken', $platform->api_token)" />
        <x-form.input label="API Secret"
                      name="apiSecret"
                      required="true"
                      :value="old('apiSecret', $platform->api_secret)" />
        <x-form.input label="API Endpoint"
                      name="apiEndpoint"
                      required="true"
                      :value="old('apiEndpoint', $platform->api_endpoint)" />

        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="submit"
                class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white"
                id="btn-submit">Save Platform </button>
        </div>

    </form>

</x-app-layout>


