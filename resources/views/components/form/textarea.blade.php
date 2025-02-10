@props(['name', 'label', 'placeholder', 'value' => '', 'rows' => 3])

<div>
    <h6>{{ $label }}</h6>
    <div class="form-floating">
        <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" rows="{{ $rows }}">{{ old($name, $value) }}</textarea>
        <label for="{{ $name }}">{{ $label }}</label>
    </div>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
