@props(['date', 'title', 'content', 'details' => null, 'id' => ''])

<div class="col-sm py-2">
    <div class="card border-success shadow">
        <div class="card-body">
            <div class="float-end text-success small">{{ $date }}</div>
            <h4 class="card-title text-success">{{ $title }}</h4>
            <p class="card-text">{{ $content }}</p>
            @if($details)
                <x-timeline.details :details="$details" :id="$id" />
            @endif
        </div>
    </div>
</div>
