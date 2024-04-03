import {serverRequest} from "./server-request.js";

export async function searchUser (value) {
    let users = await serverRequest("/users", {method: "GET"});
    let result = [];

    if (users){
        if (value.match(/^[\d.]/)) {
            users.forEach((user) => {
                if (parseInt(value) === user.id){
                    result.push(user);
                }
            });

        } else if (value.match(/^[^ ]+@[^ ]+\.[a-z]{2,3}$/)) {
            users.forEach((user) => {
                if (user.email === value.toLowerCase()){
                    result.push(user);
                }
            });

        } else if (value.match(/^([a-z\s]|[а-яё\s])+$/)) {
            users.forEach((user) => {
                if (user.name.toLowerCase().includes(value)) {
                    result.push(user);
                }
            });
        }
    }
    return result;
}