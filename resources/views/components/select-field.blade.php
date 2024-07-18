@props(['id', 'label' => false, 'model' => false, 'ignore' => false,
'required' => false, 'options' => [], 'tooltip' => '', 'placeholder' => "true", 'data' => null])

@php
$selectAttributes = $attributes->merge([
'class' => 'form-select ' . ($model && $errors->has($model) ? 'is-invalid ' : ''),
'id' => $id,
'name' => $id
]);

$wireModel = $model ? 'wire:model.live=' . $model : '';
$value = $attributes->get('value');
@endphp

@if($label)
<!-- Label section -->
<label for="{{ $id }}" class="form-label">
    {{ $label }}
    @if($required)
    <span class="text-danger"><b>*</b></span>
    @endif
</label>
@if($tooltip)
<!-- Tooltip section -->
<span data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $tooltip }}">
    <span class="badge badge-center rounded-pill bg-warning bg-glow" style="width: 15px;height:15px;">
        <i class="ti ti-question-mark" style="font-size: 0.800rem;"></i>
    </span>
</span>
@endif
@endif

<div @if($ignore) wire:ignore @endif>
    <!-- Select section -->
    <select {{ $selectAttributes }} {{ $wireModel }}>
        @if($placeholder == "true")
        <option value="" style="color: #a5a5a5">-- Pilih {{ $label }} -- </option>
        @endif
        @foreach ($options as $valueOption => $display)
        <option value="{{ $valueOption }}" {{ $valueOption == $data ? 'selected' : '' }}>{{ $display }}</option>
        @endforeach
    </select>
</div>

<!-- Error message section -->
@error($model)
<small class="error text-danger">{{ $message }}</small>
@enderror
