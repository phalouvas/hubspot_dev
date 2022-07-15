<x-hub-form title="User Details">
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{$settings->id}}</td>
            </tr>
            <tr class="table-info">
                <th colspan="2">HubsSpot User</th>
            </tr>
            <tr>
                <th>User</th>
                <td>{{$settings->user}}</td>
            </tr>
            <tr>
                <th>Hub Domain</th>
                <td>{{$settings->hub_domain}}</td>
            </tr>
            <tr>
                <th>App ID</th>
                <td>{{$settings->app_id}}</td>
            </tr>
            <tr>
                <th>Hub ID</th>
                <td>{{$settings->hub_id}}</td>
            </tr>
            <tr>
                <th>User ID</th>
                <td>{{$settings->user_id}}</td>
            </tr>
            <tr class="table-info">
                <th colspan="2">Application settings</th>
            </tr>
            <tr>
                <th>API Key</th>
                <td>***********************************</td>
            </tr>
            <tr>
                <th>Sender ID</th>
                <td>{{$settings->sender_id}}</td>
            </tr>
            <tr>
                <th>Show Reports</th>
                <td>
                    @if ($settings->show_reports)
                    <span class="badge text-success">True</span>
                    @else
                    <span class="badge text-danger">False</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Show People</th>
                <td>
                    @if ($settings->show_people)
                    <span class="badge text-success">True</span>
                    @else
                    <span class="badge text-danger">False</span>
                    @endif
                </td>
            </tr>
            <tr class="table-info">
                <th colspan="2">SMSto User</th>
            </tr>
            <tr>
                <th>id</th>
                <td>{{$settings->smsto_user['id']}}</td>
            </tr>
            <tr>
                <th>_id</th>
                <td>{{$settings->smsto_user['_id']}}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{$settings->smsto_user['name']}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$settings->smsto_user['email']}}</td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-outline-secondary text-right" href="#" onclick="history.back()"
                title="Close"><span data-feather="x" class="align-text-bottom"></span></button>
</x-hub-form>