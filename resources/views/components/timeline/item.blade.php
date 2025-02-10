@props(['date', 'title', 'content', 'details' => null, 'id' => '', 'index' => 0])

<div class="row no-gutters">
    @if ($index % 2 == 0)
        <x-timeline.spacer />
        <x-timeline.dot />
        <x-timeline.content :date="$date" :title="$title" :content="$content" :details="$details" :id="$id" />
    @else
        <x-timeline.content :date="$date" :title="$title" :content="$content" :details="$details" :id="$id" />
        <x-timeline.dot />
        <x-timeline.spacer />
    @endif
</div>
