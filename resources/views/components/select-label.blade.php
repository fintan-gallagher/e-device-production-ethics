@props(['labels', 'field' => '','selected' => null])

<select {{ $attributes->merge(['class' => 'form-select']) }}>
    @foreach ($labels as $label)
        <option value="{{ $label->id }}" {{ $selected == $label->id ? 'selected' : '' }}>
            {{ $label->name }}
        </option>
    @endforeach
</select>

@error($field)
<div class="text-red-600 text-sm">{{ $message }}</div>
@enderror
