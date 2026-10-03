@props(['label', 'name', 'type' => 'text', 'value' => null])

<label class="field">
    <span>{{ $label }}</span>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $type === 'password' ? '' : old($name, $value) }}"
        {{ $attributes }}
    >
    @error($name)
        <small>{{ $message }}</small>
    @enderror
</label>
