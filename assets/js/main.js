import {popupParams, paginationParams, mutationParams} from "./params.js";
import {clearMessage} from "./messages-funcs.js";
import {serverRequest} from "./server-request.js";
import {paginate} from "./pagination.js";
import {renderPopup} from "./popup-funcs.js";
import {searchUser} from "./search-user.js";

(async function userManagementSystem () {
    if (document.querySelector(".table_users")){
        const userTable = document.querySelector(".table_users");
        const userTableBody = userTable.children[1];

        // Mutation observer monitors the addition of new rows in the table and attaches event listeners to them
        let mutationObserver = new MutationObserver(mutationParams.userRow.callback);
        mutationObserver.observe(userTableBody, mutationParams.userRow.options);

        let users = await serverRequest("/users", {method: "GET"});
        paginate(userTable, users, paginationParams.userTable);

        // Refresh users table
        if (document.querySelector(".top-panel__button_refresh")){
            const refreshButton = document.querySelector(".top-panel__button_refresh");
            refreshButton.addEventListener("click", async () => {
                clearMessage();

                let users = await serverRequest("/users", {method: "GET"});
                paginate(userTable, users, paginationParams.userTable);
            });
        }

        // Add new user
        if (document.querySelector(".top-panel__button_add-user")){
            const addUserButton = document.querySelector(".top-panel__button_add-user");
            addUserButton.addEventListener("click", async () => {
                await renderPopup(popupParams.addUser);
            });
        }

        // User search bar
        if (document.querySelector(".top-panel__search-bar")){
            const searchBar = document.querySelector(".top-panel__search-bar"),
                searchLine = searchBar.children[0],
                clearButton = searchBar.children[1],
                searchButton = searchBar.children[2];

            searchLine.addEventListener("input", async () => {
                const searchValue = searchLine.value;
                if (searchValue){
                    clearButton.classList.add("show");
                } else {
                    clearButton.classList.remove("show");
                }
            });

            clearButton.addEventListener("click", async () => {
                searchLine.value = "";
                clearButton.classList.remove("show");
            });

            searchButton.addEventListener("click", async () => {
                clearMessage();
                const searchValue = searchLine.value.toLowerCase().trim();

                if (searchValue){
                    let foundUsers = await searchUser(searchValue);
                    paginate(userTable, foundUsers, paginationParams.userTable);
                }
            });
        }
    }
}());






