<!-- resources/views/components/form-select.blade.php -->
@props(['name', 'label', 'options', 'value' => ''])

<div>
    <h6>{{ $label }}</h6>
    <div class="input-group">
        <label class="input-group-text" for="{{ $name }}">{{ $label }}</label>
        <select class="form-select @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
            <option selected disabled>Choose...</option>
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>{{ $optionLabel }}</option>
            @endforeach
        </select>
    </div>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
