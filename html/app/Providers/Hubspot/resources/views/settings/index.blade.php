<x-hub-layout title="Users">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <form class="d-flex" role="search" method="POST" action="{{route('hubspot.admin.settings.index')}}">
                @csrf
                <input class="form-control me-2" type="search" id="search" name="search" placeholder="Search..." aria-label="Search" value="{{request()->search}}">
                <button class="btn btn-outline-primary" type="submit" title="Search"><span data-feather="search" class="align-text-bottom"></span></button>
            </form>
        </div>
    </nav>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>HubsSpot Hub ID</th>
                    <th>HubsSpot User ID</th>
                    <th>SMSto ID</th>
                    <th>SMSto Auth ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($settings as $setting)
                <tr>
                    <td>{{ $setting['id'] }}</td>
                    <td>{{ $setting['hub_id'] }}</td>
                    <td>{{ $setting['user_id'] }}</td>
                    <td>{{ $setting['smsto_user']['id'] }}</td>
                    <td>{{ $setting['smsto_user']['_id'] }}</td>
                    <td>{{ $setting['smsto_user']['name'] }}</td>
                    <td>{{ $setting['smsto_user']['email'] }}</td>
                    <td>
                        <form method="POST"
                            action="{{route('hubspot.admin.settings.destroy', ['settings' => $setting])}}">
                            @csrf
                            <div class="btn-group" role="toolbar" aria-label="Toolbar with button groups">
                                <a href="{{route('hubspot.admin.settings.show', ['settings' => $setting])}}"
                                    class="btn btn-outline-primary" title="Details"><span data-feather="zoom-in"
                                        class="align-text-bottom"></span></a>
                                <button type="button" class="btn btn-outline-danger" title="Delete"
                                    onclick="if (confirm('You are about to permanently delete this item. Are you sure?')) {submit()}">
                                    <span data-feather="trash" class="align-text-bottom"></span>
                                </button>
                            </div>
                        </form>
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