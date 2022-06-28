<x-hub-layout>

    <x-slot:title>
        Action - {{$labels['en']['actionName']}}
        </x-slot>

        <p>Revision id: {{$revisionId}}</p>
        <form method="POST" action="{{route('hubspot.admin.actions.update', ['action_id' => $id])}}">
            @csrf
            <div class="mb-3">
                <label for="actionUrl" class="form-label">actionUrl</label>
                <input type="url" class="form-control" id="actionUrl" name="actionUrl" aria-describedby="actionUrlHelp"
                    value="{{$actionUrl}}">
                <div id="actionUrlHelp" class="form-text">The URL that will accept an HTTPS request each time actions
                    executes the custom action.</div>
            </div>
            <div class="mb-3">
                <select class="form-select" aria-describedby="publishedHelp" id="published" name="published">
                    <option {{$published ? 'selected' : '' }} value="1">Published</option>
                    <option {{!$published ? 'selected' : '' }} value="0">Unpublished</option>
                </select>
                <div id="publishedHelp" class="form-text">Whether this custom action is published to customers.</div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#archiveModal">
                Archive
            </button>
            <a href="{{route('hubspot.admin.actions.index')}}" class="btn btn-secondary">Close</a>
        </form>

        <!-- Archive Modal -->
        <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Archive</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Actions that currently use this custom action will stop attempting to execute the action, and all future executions will be marked as a failure.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{route('hubspot.admin.actions.archive', ['action_id' => $id])}}" class="btn btn-danger">Submit</a>
                    </div>
                </div>
            </div>
        </div>

</x-hub-layout>
