<x-hub-layout title="Users">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Hub Domain</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($settings as $setting)
                <tr>
                    <td>{{ $setting['id'] }}</td>
                    <td>{{ $setting['user'] }}</td>
                    <td>{{ $setting['hub_domain'] }}</td>
                    <td>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <a href="{{route('hubspot.web.settings.edit')}}?appId={{$setting->app_id}}&portalId={{$setting->hub_id}}&userId={{$setting->user_id}}" class="btn btn-success" title="Edit"><span data-feather="edit" class="align-text-bottom"></span></a>
                            <a href="{{route('hubspot.admin.settings.show', ['settings' => $setting])}}" class="btn btn-warning" title="Details"><span data-feather="zoom-in" class="align-text-bottom"></span></a>
                            <form method="POST"
                                action="{{route('hubspot.admin.settings.destroy', ['settings' => $setting])}}">
                                @csrf
                                <button type="button" class="btn btn-danger" title="Delete"
                                    onclick="if (confirm('You are about to permanently delete this item. Are you sure?')) {submit()}">
                                    <span data-feather="trash" class="align-text-bottom"></span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        {!! $settings->links() !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</x-hub-layout>
