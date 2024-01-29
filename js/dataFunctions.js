
$('#update-category').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var category_id = button.data('categoryid')
    var category_name = button.data('categoryname')
    var category_short = button.data('categoryshort')
    var modal = $(this)
    modal.find('.modal-body #category_id').val(category_id);
    modal.find('.modal-body #category_name').val(category_name);
    modal.find('.modal-body #category_short').val(category_short);
})
$('#delete-category').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var category_id = button.data('categoryid');
    var modal = $(this)
    modal.find('.modal-body #category_id').val(category_id);
})
$('#update-size').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var size_id = button.data('sizeid')
    var size_name = button.data('sizename')
    var size_short = button.data('sizeshort')
    var uom_id = button.data('uomid')
    var uom_name = button.data('uomname')
    var modal = $(this)
    modal.find('.modal-body #size_id').val(size_id);
    modal.find('.modal-body #size_name').val(size_name);
    modal.find('.modal-body #size_short').val(size_short);
    modal.find('.modal-body #uom_id').val(uom_id);
    modal.find('.modal-body #uom_id').text(uom_name);
})
$('#delete-size').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var size_id = button.data('sizeid');
    var modal = $(this)
    modal.find('.modal-body #size_id').val(size_id);
})
$('#update-uom').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var uom_id = button.data('uomid')
    var uom_name = button.data('uomname')
    var uom_short = button.data('uomshort')
    var category_name = button.data('categoryname')
    var category_id = button.data('categoryid')
    var modal = $(this)
    modal.find('.modal-body #uom_id').val(uom_id);
    modal.find('.modal-body #uom_name').val(uom_name);
    modal.find('.modal-body #uom_short').val(uom_short);
    modal.find('.modal-body #category_id').val(category_id);
    modal.find('.modal-body #category_id').text(category_name);
})
$('#delete-uom').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var uom_id = button.data('uomid');
    var modal = $(this)
    modal.find('.modal-body #uom_id').val(uom_id);
})
$('#update-topping').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var topping_id = button.data('toppingid')
    var topping_name = button.data('toppingname')
    var topping_short = button.data('toppingshort')
    var uom_id = button.data('uomid')
    var uom_name = button.data('uomname')
    var modal = $(this)
    modal.find('.modal-body #uom_id').val(uom_id);
    modal.find('.modal-body #uom_id').text(uom_name);
    modal.find('.modal-body #topping_id').val(topping_id);
    modal.find('.modal-body #topping_name').val(topping_name);
    modal.find('.modal-body #topping_short').val(topping_short);
})
$('#delete-topping').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var topping_id = button.data('toppingid');
    var modal = $(this)
    modal.find('.modal-body #topping_id').val(topping_id);
})
$('#update-flavour').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var flavour_id = button.data('flavourid')
    var flavour_name = button.data('flavourname')
    var flavour_short = button.data('flavourshort')
    var category_name = button.data('categoryname')
    var category_id = button.data('categoryid')
    var modal = $(this)
    modal.find('.modal-body #flavour_id').val(flavour_id);
    modal.find('.modal-body #flavour_name').val(flavour_name);
    modal.find('.modal-body #flavour_short').val(flavour_short);
    modal.find('.modal-body #category_id').val(category_id);
    modal.find('.modal-body #category_id').text(category_name);
})
$('#delete-flavour').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var flavour_id = button.data('flavourid');
    var modal = $(this)
    modal.find('.modal-body #flavour_id').val(flavour_id);
})
$('#update-table').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var table_id = button.data('tableid')
    var table_name = button.data('tablename')
    var table_capacity = button.data('tablecapacity')
    var modal = $(this)
    modal.find('.modal-body #table_id').val(table_id);
    modal.find('.modal-body #table_name').val(table_name);
    modal.find('.modal-body #capacity').val(table_capacity);
})
$('#delete-table').on('show.bs.modal',function (event){
    var button = $(event.relatedTarget)
    var table_id = button.data('tableid');
    var modal = $(this)
    modal.find('.modal-body #table_id').val(table_id);
})


   
