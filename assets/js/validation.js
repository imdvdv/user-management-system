import {validationParams} from "./params.js";
import {showError} from "./messages-funcs.js";

export function validateFields(fields, params= validationParams.fields) {
    let isValid = true;

    fields.forEach((field) => {
        let input = field.children[0].children[1];
        let inputKey = input.id;
        let inputValue = input.value.trim();

        if (inputValue === "") {
            showError(field, `${inputKey} is required`, "invalid");
            isValid = false;
        } else if (!(inputValue.match(params[`${inputKey}`]["pattern"]))) {
            showError(field, params[`${inputKey}`]["error"], "invalid");
            isValid = false;
        }

    });
    return isValid;
}

