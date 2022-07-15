<x-hub-form title="Settings Edit">
    <form action="{{route('hubspot.web.settings.update', ['settings' => $settings->id])}}" method="POST">
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

        <div class="mb-3">
            <label for="show_reports" class="form-label">Show Reports</label>
            <div class="mb-3 btn-group" role="group" aria-label="Show Reports Group">
                <input type="radio" class="btn-check" id="show_reports_true" name="show_reports" autocomplete="off"
                    aria-describedby="show_reportsHelp" class="@error('show_reports') is-invalid @enderror" {{
                    $settings->show_reports ? 'checked' : ''}} value="1" >
                <label for="show_reports_true" class="btn btn-outline-success">Yes</label>
                <input type="radio" class="btn-check" id="show_reports_false" name="show_reports" autocomplete="off"
                    aria-describedby="show_reportsHelp" class="@error('show_reports') is-invalid @enderror" {{
                    !$settings->show_reports ? 'checked' : '' }} value="0">
                <label for="show_reports_false" class="btn btn-outline-danger">No</label>
            </div>
            <div id="show_reportsHelp" class="form-text">
                Whether to show all messages log, or not.
            </div>
            @error('show_reports')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="show_people" class="form-label">Show People</label>
            <div class="mb-3 btn-group" role="group" aria-label="Show People Group">
                <input type="radio" class="btn-check" id="show_people_true" name="show_people" autocomplete="off"
                    aria-describedby="show_peopleHelp" class="@error('show_people') is-invalid @enderror" {{
                    $settings->show_people ? 'checked' : ''}} value="1" >
                <label for="show_people_true" class="btn btn-outline-success">Yes</label>
                <input type="radio" class="btn-check" id="show_people_false" name="show_people" autocomplete="off"
                    aria-describedby="show_peopleHelp" class="@error('show_people') is-invalid @enderror" {{
                    !$settings->show_people ? 'checked' : '' }} value="0">
                <label for="show_people_false" class="btn btn-outline-danger">No</label>
            </div>
            <div id="show_peopleHelp" class="form-text">
                Whether to people, or not.
            </div>
            @error('show_people')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-primary">Submit</button>

    </form>
</x-hub-form>