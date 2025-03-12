<div class="row">

    <div class="col-md-6 mb-3">
    @include('admin.includes.form.select', [
          'label' => __('site.cases'),
          'options' => $array,
        'fieldName' => 'case_id',
    'fieldValue' =>   isset($slider)&& $slider->case_id?$slider->case_id:null,
        'class' => 'select2 form-select',
    ])
      </div>
    </div>
    <br>
    <div class="col-md-6 mb-3">
        @include('admin.includes.form.active', ['var' => isset($slider) ? $slider : null])        
        
        </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">@lang('site.image')</label>
        <!-- Browse image button -->
        <span class="note needsclick btn bg-label-primary d-inline"
            id="btnBrowse">@lang('site.image')</span>
        <!-- Hidden file input -->
        <input type="file" id="imageInput" name="image" style="display: none;"
            accept="image/*">
        <!-- Image preview -->
        @if(isset($slider))
        <div id="imagePreview" style="margin-top: 20px;">
            @if ($slider->image)
            <img id="previewImg" src="{{ asset('uploads/' . $slider->image) }}"
                alt="Image Preview" style="max-width: 50%;">
            @else
            <img id="previewImg" src="" alt="Image Preview"
                style="max-width: 50%; display: none;">
            @endif
        </div>
        @else
        <div id="imagePreview" style="margin-top: 20px;" >
            <img id="previewImg" src="" alt="Image Preview" style="width: 50%; display: none;">
          </div>
        @endif
    </div>
    {!! Form::close() !!}

      