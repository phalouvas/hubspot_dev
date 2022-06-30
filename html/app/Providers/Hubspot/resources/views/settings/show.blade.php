<x-hub-layout title="User Details">
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
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{route('hubspot.settings.edit')}}?appId={{$settings->app_id}}&portalId={{$settings->hub_id}}&userId={{$settings->user_id}}" class="btn btn-success" title="Edit"><span data-feather="edit" class="align-text-bottom"></span></a>
                        <a href="{{route('hubspot.admin.settings.index')}}" class="btn btn-secondary" title="Close"><span data-feather="x" class="align-text-bottom"></span></a>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</x-hub-layout>
