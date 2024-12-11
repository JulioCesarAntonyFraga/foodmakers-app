var optionalFieldsIds = []

function formIsValid(button){
    var form = button.form;
    var isValid = true;
    var fields = [];
    var inputs = form.getElementsByTagName('input');
    var textareas = form.getElementsByTagName('textarea');

    for (const [key, value] of Object.entries(inputs)) {
        fields.push(value);
    }
    for (const [key, value] of Object.entries(textareas)) {
        fields.push(value);
    }

    console.log(fields);

    for (var i = 0; i < fields.length; i++){
        if (fields[i].value == '' && !optionalFieldsIds.includes(fields[i].id)){
            isValid = false;
            fields[i].style.border = '1px solid red';
        }
        else{
            fields[i].style.border = '0.5px solid #e0e0e0';
        }
    }

    return isValid;
}

function login(button){
    if (!formIsValid(button)){
        return;
    }

    button.form.submit();
}
