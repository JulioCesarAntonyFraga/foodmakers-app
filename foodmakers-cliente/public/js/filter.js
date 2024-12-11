function filterProducts(select){
    var category = select.value;
    var form = select.form;
    form.action = '/product-list/' + category;
    form.submit();
    console.log(form.action);
}
