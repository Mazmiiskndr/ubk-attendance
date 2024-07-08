@props(['id', 'label' => false, 'model' => false, 'placeholder' => '',
'required' => false,'tooltip' => '', 'rows' => ''])

@if($label)
<label for="{{ $id }}" class="form-label">{{ $label }} @if($required)<span class="text-danger"><b>*</b></span>@endif</label>
@if($tooltip)
<span data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $tooltip }}"><span class="badge badge-center rounded-pill bg-warning bg-glow" style="width: 15px;height:15px;"><i class="ti ti-question-mark" style="font-size: 0.800rem;"></i></span></span>
@endif
@endif

<textarea {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($model) ? 'is-invalid' : ''),
    'id' => $id, 'placeholder' => $placeholder]) }} @if($model) wire:model="{{ $model }}" @endif @if($rows) rows="{{ $rows }}" @endif>
</textarea>

@error($model)
<small class="error text-danger">{{ $message }}</small>
@enderror
