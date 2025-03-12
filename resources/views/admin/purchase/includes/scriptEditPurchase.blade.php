<script>

    $(document).ready(function() {

       $('.repeater').repeater({
           initEmpty: false,

           show: function () {
               $(this).slideDown();
               $(this).find('.select2-container').remove();
                $(this).find('select').select2({
                    dropdownParent: $(this).closest('.modal')
                });
           },
           hide: function (deleteElement) {
               if(confirm('Are you sure you want to delete this item?')) {
                   $(this).slideUp(deleteElement);
               }
           }
       });


       $('.edit-btn').on('click', function() {
           var itemsData = $(this).data('items'); // جلب البيانات من الزر

           // تنظيف الحقول الحالية داخل المودال
           $('.repeater [data-repeater-list="items"]').empty();

           // التأكد من وجود بيانات
           if (itemsData && itemsData.length > 0) {
               // إنشاء الحقول بناءً على العناصر
               itemsData.forEach(function(item, index) {
                   var newItemHtml = `
                       <div class="row" data-repeater-item>
                           <div class="col-md-4 mb-4">
                               <label class="form-label">@lang('site.item')</label>
                               <div class="position-relative">
                                   <select name="items[${index}][item_id]" class="form-select">
                                       @foreach ($categories as $category)
                                       <optgroup label="{{ $category->nameLang() }}">
                                           @foreach ($category->items as $item)
                                           <option value="{{ $item->id }}" ${item.pivot.item_id == {{ $item->id }} ? 'selected' : ''}>
                                               {{ $item->nameLang() }}
                                           </option>
                                           @endforeach
                                       </optgroup>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           <div class="col-sm-3">
                               <label class="form-label">@lang('site.amount')</label>
                               <input type="number" class="form-control" name="items[${index}][amount]" value="${item.pivot.amount}" />
                           </div>
                           <div class="col-sm-3">
                               <label class="form-label">@lang('site.unit_price')</label>
                               <input type="number" class="form-control" name="items[${index}][unit_price]" value="${item.pivot.unit_price}" />
                           </div>
                           <div class="col-md-2">
                               <button type="button" data-repeater-delete class="btn btn-danger mt-4">@lang('site.delete')</button>
                           </div>
                       </div>
                   `;
                   // إضافة الحقول إلى المودال
                   $('.repeater [data-repeater-list="items"]').append(newItemHtml);
               });
           }
       });
    });
</script>
