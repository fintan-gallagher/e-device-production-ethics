@props(['manufacturers', 'field' => '','selected' => null])

<select {{ $attributes->merge(['class' => 'form-select']) }}>
    @foreach ($manufacturers as $manufacturer)
        <option value="{{ $manufacturer->id }}" {{ $selected == $manufacturer->id ? 'selected' : '' }}>
            {{ $manufacturer->name }}
        </option>
    @endforeach
</select>

@error($field)
<div class="text-red-600 text-sm">{{ $message }}</div>
@enderror
