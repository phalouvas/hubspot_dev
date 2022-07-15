<x-hub-form title="Create Custom Action">
    <form method="POST" action="{{route('hubspot.admin.actions.store')}}">
        @csrf
        <div class="mb-3">
            <select class="form-select" aria-describedby="jsonHelp" id="json_id" name="json_id" required>
                @foreach ($jsons as $key => $json)
                <option value="{{$key}}">{{$json['actionName']}}</option>
                @endforeach
            </select>
            <div id="jsonHelp" class="form-text">Make sure to select an action.</div>
        </div>
        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-outline-primary" title="Save"><span data-feather="save" class="align-text-bottom"></span></button>
            <button type="button" class="btn btn-outline-secondary text-right" href="#" onclick="history.back()"
                title="Close"><span data-feather="x" class="align-text-bottom"></span></button>
        </div>

    </form>
</x-hub-form>