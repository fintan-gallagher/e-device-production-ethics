<!-- resources/views/components/record-checkbox.blade.php -->

<div>
    <label for="record_{{ $record->id }}">
        <input type="checkbox" id="record_{{ $record->id }}" name="records[]" value="{{ $record->id }}" {{ $checked ? 'checked' : '' }}>
        {{ $record->title }}
    </label>
</div>
