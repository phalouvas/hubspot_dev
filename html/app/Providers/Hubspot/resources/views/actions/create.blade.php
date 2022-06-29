<x-hub-layout title="Create Custom Action">
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
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{route('hubspot.admin.actions.index')}}" class="btn btn-secondary">Close</a>
    </form>
</x-hub-layout>
