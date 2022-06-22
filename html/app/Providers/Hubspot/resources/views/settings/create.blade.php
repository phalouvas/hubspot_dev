<form action="/hubspot/settings/store" method="POST">
    @csrf
    <input id="code" name="code" type="hidden" value="{{ $code }}" <label for="api_key">API Key</label>
    <input id="api_key" name="api_key" type="text" class="@error('api_key') is-invalid @enderror" required>
    @error('api_key')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br />
    <label for="sender_id">Sender ID</label>
    <input id="sender_id" name="sender_id" type="text" class="@error('sender_id') is-invalid @enderror" required>
    @error('sender_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br />
    <label for="show_reports">Show Reports</label>
    <input id="show_reports" name="show_reports" type="checkbox" class="@error('show_reports') is-invalid @enderror"
        checked>
    @error('show_reports')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br />
    <label for="show_people">Show People</label>
    <input id="show_people" name="show_people" type="checkbox" class="@error('show_people') is-invalid @enderror"
        checked>
    @error('show_people')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br />
    <input type="submit" value="Submit">

</form>
