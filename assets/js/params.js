import {clearErrors} from "./messages-funcs.js";
import {closePopup, renderPopup} from "./popup-funcs.js";
import {serverRequest} from "./server-request.js";
import {validateFields} from "./validation.js";
import {paginate} from "./pagination.js";

export const validationParams = {
    fields: {
        name: {
            pattern: /^([A-Za-z\s]{2,30}|[А-ЯЁа-яё\s]{2,30})$/,
            error: "name must be at least 2 characters and contain only letters",
        },
        email: {
            pattern: /^[^ ]+@[^ ]+\.[a-z]{2,3}$/,
            error: "enter a valid email address",
        },
        password: {
            pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/,
            error: "password must be at least 6 character with number, small and capital letter",
        },
    }
}

export const paginationParams = {
    userTable: {
        pagesLimit: 7,
        rowsLimit: 10,
        tableHeadRender: (tableHead) => {
            const row = document.createElement(`tr`)
            row.classList.add("table__row", "table__row_head");
            const rowHTML = `
                <th class="table__head-cell table__head-cell_id">ID</th>
                <th class="table__head-cell table__head-cell_name">Name</th>
                <th class="table__head-cell table__head-cell_email">Email</th>
                <th class="table__head-cell table__head-cell_actions">Actions</th>
            `;
            row.innerHTML = rowHTML;
            tableHead.appendChild(row);
        },
        tableBodyRender: (tableBody, userData) => {
            const row = document.createElement("tr")
            row.classList.add("table__row", `table__row_user-${userData.id}`);
            const rowHTML = `
                <td class="table__body-cell table__body-cell_id">${userData.id}</td>
                <td class="table__body-cell table__body-cell_name">${userData.name}</td>
                <td class="table__body-cell table__body-cell_email">${userData.email}</td>
                <td class="table__body-cell table__body-cell_actions">
                  <div class="table__buttons">
                    <button class="table__button table__button_edit">Edit</button>
                    <button class="table__button table__button_delete">Delete</button>
                  </div>
                </td>`;
            row.innerHTML = rowHTML;
            tableBody.appendChild(row);
        },
    }
}

export const popupParams = {
    addUser: {
        contentPath: "/components/popup/user-form-content.html",
        contentAction: async () => {
            const usersTable = document.querySelector(".table_users"),
                userForm = document.querySelector(".form_user"),
                fields = userForm.querySelectorAll(".form__field");

            userForm.addEventListener("submit", async (e) => {
                e.preventDefault();
                clearErrors();

                if (validateFields(fields)) {
                    let bodyData = new FormData(userForm);
                    let options = {
                        method: "POST",
                        body: bodyData,
                    };

                    if (await serverRequest("/users", options)){
                        closePopup();
                        let users = await serverRequest("/users", {method: "GET"});
                        let lastPage = Math.ceil(users.length / paginationParams.userTable.rowsLimit);
                        paginate(usersTable, users, paginationParams.userTable, lastPage);
                    }
                }
            });
        },
    },
    editUser: {
        contentPath: "/components/popup/user-form-content.html",
        contentAction: async (editButton) => {
            const row = editButton.parentNode.closest(".table__row"),
                usersTable = row.parentNode.parentNode,
                userID = row.children[0].innerText,
                userNameDB = row.children[1].innerText,
                userEmailDB = row.children[2].innerText,
                userForm = document.querySelector(".form_user"),
                fields = userForm.querySelectorAll(".form__field"),
                inputName = userForm.querySelector("#name"),
                inputEmail = userForm.querySelector("#email");

            let nameValue = inputName.value;
            let emailValue = inputEmail.value;
            inputName.value = userNameDB;
            inputEmail.value = userEmailDB;

            userForm.addEventListener("submit", async (e) => {
                e.preventDefault();
                clearErrors ();

                if (validateFields(fields)) {
                    nameValue = inputName.value;
                    emailValue = inputEmail.value;

                    let bodyData = new URLSearchParams();
                    bodyData.append("name", nameValue);
                    bodyData.append("email", emailValue);

                    let options = {
                        method: "PATCH",
                        body: bodyData,
                    };

                    if (await serverRequest(`/users/${userID}`, options)){
                        closePopup();
                        let activePage = 1;

                        if (document.querySelector(".page_active")) {
                            activePage = parseInt(document.querySelector(".page_active").innerText);
                        }
                        let users = await serverRequest("/users", {method: "GET"});
                        paginate(usersTable, users, paginationParams.userTable, activePage);
                    }
                }
            });
        },
    },
    deleteUser: {
        contentPath: "/components/popup/delete-user-content.html",
        contentAction: async (deleteButton) => {
            const row = deleteButton.parentNode.closest(".table__row"),
                userID = row.children[0].innerText,
                usersTable = row.parentNode.parentNode,
                usersTableBody = usersTable.children[1];

            if (document.querySelector(".popup__text")){
                const popupTittle = document.querySelector(".popup__text");
                popupTittle.innerText = `Are you sure you want to delete user (ID-${userID})?`;
            }

            const confirmButton = document.querySelector(".confirm-popup");
            confirmButton.addEventListener("click", async () => {

                let options = {method: "DELETE"};

                if (await serverRequest(`/users/${userID}`, options)){
                    closePopup();
                    let activePage = 1;

                    if (document.querySelector(".page_active")) {
                        activePage = parseInt(document.querySelector(".page_active").innerText);

                        if (usersTableBody.childNodes.length === 1 && activePage !== 1) {
                            activePage = activePage - 1;
                        }
                    }
                    let users = await serverRequest("/users", {method: "GET"});
                    paginate(usersTable, users, paginationParams.userTable, activePage);
                }
            });
        },
    },
}

export const mutationParams = {
    userRow: {
        options: {childList: true},
        callback: (mutations) => {

            // The function adds event listeners for edit and delete user on each new row
            mutations.forEach(function(mutation) {
                if (mutation.type === "childList" && mutation.addedNodes.length > 0) {
                    let addedElement = mutation.addedNodes[0];

                    if (addedElement.classList.contains("table__row")) {
                        const actionCell = addedElement.lastChild,
                            editButton = actionCell.children[0].children[0],
                            deleteButton = actionCell.children[0].children[1];

                        editButton.addEventListener("click", async () => {
                            await renderPopup(popupParams.editUser, editButton);
                        });
                        deleteButton.addEventListener("click", async () => {
                            await renderPopup(popupParams.deleteUser, deleteButton);
                        });
                    }
                }
            });
        },
    }
}






