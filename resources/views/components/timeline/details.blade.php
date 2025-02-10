@props(['id', 'details' => [], 'btnLabel' => 'Show Details ▼'])

<div>
    <button class="btn btn-sm btn-outline-secondary mb-3" type="button" data-bs-target="#{{ $id }}_details" data-bs-toggle="collapse">{{ $btnLabel }}</button>
    <div class="collapse border" id="{{ $id }}_details">
        <div class="p-2 text-monospace">
            @foreach($details as $detail)
                <div>{{ $detail }}</div>
            @endforeach
        </div>
    </div>
</div>
