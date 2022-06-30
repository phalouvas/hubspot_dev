<x-hub-layout title="Settings Details">
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{$settings->id}}</td>
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
            <tr>
                <th>API Key</th>
                <td></td>
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
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <a href="{{route('hubspot.admin.settings.index')}}" class="btn btn-secondary"><span data-feather="x" class="align-text-bottom" title="Close"></span></a>
                </td>
            </tr>
        </tfoot>
    </table>
</x-hub-layout>
