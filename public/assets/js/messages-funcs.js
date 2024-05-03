
export function showMessage (successStatus, messageString) {
    if (document.querySelector(".message")){
        const message = document.querySelector(".message"),
            messageText = message.querySelector(".message-text");
        if (successStatus) {
            if (message.classList.contains("failure")){
                message.classList.remove("failure")
            }
            message.classList.add("success");
        } else {
            if (message.classList.contains("success")){
                message.classList.remove("success")
            }
            message.classList.add("failure");
        }
        message.classList.add("show");
        messageText.textContent = messageString;
    }
}

export function showError (field, errorString, validationClass = null) {
    const error = field.children[1],
        errorText = error.children[1];

    if (validationClass) {
        field.classList.add(validationClass);
    }
    error.classList.add("show");
    errorText.textContent = errorString;
}

export function clearMessage () {
    if (document.querySelector(".message")) {
        const message = document.querySelector(".message");
        message.classList.remove("show", "failure", "success");
    }
    if (sessionStorage["status"] && sessionStorage["message"]){
        delete sessionStorage["status"];
        delete sessionStorage["message"];
    }
}

export function clearErrors () {
    if (document.querySelector(".form__field")){
        const fields = document.querySelectorAll(".form__field");
        fields.forEach(function (field) {
            const error = field.children[1];
            error.classList.remove("show");
            field.classList.remove("invalid");
        });
    }
}

export function clearAllMessages () {
    clearMessage();
    clearErrors();
}

