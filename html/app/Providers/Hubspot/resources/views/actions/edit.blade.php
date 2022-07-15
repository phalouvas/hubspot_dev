<x-hub-form title="Edit Action">
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
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-outline-primary" title="Save"><span data-feather="save"
                    class="align-text-bottom"></button>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#archiveModal"
                title="Archive">
                <span data-feather="trash" class="align-text-bottom">
            </button>
            <button type="button" class="btn btn-outline-secondary text-right" href="#" onclick="history.back()"
                title="Close"><span data-feather="x" class="align-text-bottom"></span></button>
        </div>
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
                    Actions that currently use this custom action will stop attempting to execute the action, and all
                    future executions will be marked as a failure.
                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" title="Close"><span
                                data-feather="x" class="align-text-bottom"></a></button>
                        <a href="{{route('hubspot.admin.actions.archive', ['action_id' => $id])}}"
                            class="btn btn-outline-danger" title="Submit"><span data-feather="trash"
                                class="align-text-bottom"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-hub-form>