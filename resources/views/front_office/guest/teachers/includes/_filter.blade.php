{!! form_start($form) !!}
{{-- <div class="spinner-border js-loading" role="status" aria-hidden="true" style="display: none;">
    <span class="sr-only">loading...</span>
</div> --}}
{!! form_row($form->q)!!}
<h5 style='font-weight: bold;'>{{ __('Subjects')}}</h5>
{!! form_row($form->subjects)!!}
<h5 style='font-weight: bold;'>{{ __('Gender') }}</h5>
{!! form_row($form->gender)!!}
<h5 style='font-weight: bold;'>{{ __('Pricing') }} ({{ __('QR') }})</h5>
<div style='display: flex;flex-direction: row;'>
    {!! form_row($form->min)!!}
    <div style="width: 30px"></div>
    {!! form_row($form->max)!!}
</div>
<div class="pricing-slider" data-min={{$min}} data-max={{$max}}></div>

{!! form_end($form) !!}