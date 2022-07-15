<x-hub-layout title="Actions">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <td colspan="4">
                        <div class="btn-group" role="group">
                            <a href="{{route('hubspot.admin.actions.create')}}" class="btn btn-outline-primary" title="Create"><span data-feather="plus" class="align-text-bottom"></span></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>id</th>
                    <th>actionName</th>
                    <th>actionUrl</th>
                    <th>published</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                <tr>
                    <td>{{ $result['id'] }}</td>
                    <td><a href="{{route('hubspot.admin.actions.edit', ['action_id' => $result['id']])}}">{{
                            $result['labels']['en']['actionName'] }}</a></td>
                    <td>{{ $result['actionUrl'] }}</td>
                    <td>
                        @if ($result['published'])
                        <span class="badge bg-success">Yes</span>
                        @else
                        <span class="badge bg-danger">No</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-hub-layout>
