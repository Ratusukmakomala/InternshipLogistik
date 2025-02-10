<!-- resources/views/components/form-input.blade.php -->
@props(['name', 'type' => 'text', 'label', 'placeholder', 'icon', 'value' => ''])

<div>
    <h6>{{ $label }}</h6>
    <div class="form-group position-relative has-icon-left">
        <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ old($name, $value) }}">
        <div class="form-control-icon">
            <i class="{{ $icon }}"></i>
        </div>
        @error($name)
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
