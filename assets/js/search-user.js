import {serverRequest} from "./server-request.js";

export async function searchUser (value) {
    
    let result = [],
    nameRegex = /^([a-z\s]|[а-яё\s])+$/,
    emailRegex = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    // Search by id
    if (value.match(/^[\d.]/)) {

        let response = await serverRequest(`/users/${value}`, {method: "GET"});
        if (typeof response.status === "undefined" && typeof response.id === "number"){
            result.push(response);
        }

    // Search by name and email
    } else if (value.match(emailRegex) || value.match(nameRegex)) {

        let response = await serverRequest("/users", {method: "GET"});
        if (Array.isArray(response) && response.length > 0) {
            response.forEach((user) => {
                if (typeof user.email !== "undefined" && user.email === value || typeof user.name !== "undefined" && user.name.toLowerCase().includes(value)){
                    result.push(user);
                }
            });
        }

    }
    return result;
}