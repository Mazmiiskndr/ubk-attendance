@props([
'id',
'label' => false,
'model' => false,
'ignore' => false,
'type' => 'text',
'placeholder' => '',
'required' => false,
'tooltip' => '',
'min' => false,
'max' => false
])

@php
$inputAttributes = $attributes->merge([
'class' => 'form-control ' . ($errors->has($model) ? 'is-invalid' : ''),
'id' => $id,
'type' => $type,
'placeholder' => $placeholder
]);

$wireModel = $ignore ? 'wire:model.defer' : 'wire:model.live';

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
    <!-- Input section -->
    <input {{ $inputAttributes }} @if($model) {{ $wireModel }}="{{ $model }}" @endif @if($type==='number' ) @if($min !==false) min="{{ $min }}" @endif @if($max !==false) max="{{ $max }}" @endif @endif />
</div>

<!-- Error message section -->
@error($model)
<small class="error text-danger">{{ $message }}</small>
@enderror
