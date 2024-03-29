<!-- resources/views/components/device-checkbox.blade.php -->

<div>
    <label for="device_{{ $device->id }}">
        <input type="checkbox" id="device_{{ $device->id }}" name="devices[]" value="{{ $device->id }}" {{ $checked ? 'checked' : '' }}>
        {{ $device->model }}
    </label>
</div>
