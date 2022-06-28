<x-hub-layout>

    <x-slot:title>
        Settings
        </x-slot>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($settings as $setting)
                    <tr>
                        <td>{{ $setting['id'] }}</td>
                        <td>{{ $setting['user'] }}</td>
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
