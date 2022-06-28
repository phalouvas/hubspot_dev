<x-hub-layout>

    <x-slot:title>
        Settings Edit
        </x-slot>

        <form action="{{route('hubspot.settings.update', ['settings' => $settings->id])}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="api_key" class="form-label">API Key</label>
                <input type="password" class="form-control" id="api_key" name="api_key" aria-describedby="api_keyHelp"
                    class="@error('api_key') is-invalid @enderror" value="{{$settings->api_key}}" required />
                <div id="api_keyHelp" class="form-text">
                    To send successful SMS, you need a <a
                        href="https://support.sms.to/en/support/solutions/articles/43000571250-account-creation-verification"
                        target="_blank">verified account on SMS.to</a> and to authorize the API calls using your api
                    key.<br>You can generate, retrieve and manage your <em>API keys</em> or <em>Client IDs &amp;
                        Secrets</em> in your <a href="https://sms.to/app" target="_blank">SMS.to dashboard</a> under the
                    <a href="https://sms.to/app#/api/client" target="_blank">API Clients</a> section.
                </div>
                @error('api_key')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sender_id" class="form-label">Sender ID</label>
                <input type="text" class="form-control" id="sender_id" name="sender_id" aria-describedby="sender_idHelp"
                    class="@error('sender_id') is-invalid @enderror" value="{{$settings->sender_id}}">
                <div id="sender_idHelp" class="form-text">
                    The displayed value of who sent the message <a
                        href="https://intergo.freshdesk.com/a/solutions/articles/43000513909" target="_blank">More
                        info</a>
                </div>
                @error('sender_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

</x-hub-layout>
