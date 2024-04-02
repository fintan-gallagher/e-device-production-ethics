<div>
    <label for="parts_availability" class="block font-medium text-sm text-gray-700">Parts Available?</label>
    <select name="parts_availability" id="parts_availability" class="form-select mt-1 block w-full">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>

    @error($field)
        <div class="text-red-600 text-sm">{{ $message }}</div>
    @enderror
</div>
