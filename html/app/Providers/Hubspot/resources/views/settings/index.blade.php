<x-hub-layout>

    <x-slot:title>
        Users
        </x-slot>

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
                            <form method="POST"
                                action="{{route('hubspot.admin.settings.destroy', ['settings' => $setting])}}">
                                @csrf
                                <button type="button" class="btn btn-danger"
                                    title="Delete"
                                    onclick="if (confirm('You are about to permanently delete this item. Are you sure?')) {submit()}">
                                    <span data-feather="trash" class="align-text-bottom"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            {!! $settings->links() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

</x-hub-layout>
