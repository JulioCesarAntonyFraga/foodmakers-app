var maxAmount = 10;

function addProduct(element){
    var actionsElement = element.parentNode;
    var amountElement = actionsElement.querySelector("#amount");
    var amount = Number(amountElement.innerHTML);

    if(amount >= maxAmount){
        return;
    }

    amountElement.innerHTML = " " + (amount + 1) + " ";
}

function removeProduct(element){
    var actionsElement = element.parentNode;
    var amountElement = actionsElement.querySelector("#amount");
    var amount = Number(amountElement.innerHTML);

    if (amount > 0){
        amountElement.innerHTML = " " + (amount - 1) + " ";
    }
}