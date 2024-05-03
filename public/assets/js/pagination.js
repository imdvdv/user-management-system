import {showMessage ,clearAllMessages} from "./messages-funcs.js";

export function paginate (table, data, params, activePage = 1) {
    const tableHead = table.children[0];
    const tableBody = table.children[1];
    const container = table.parentNode;
    const pagination = container.querySelector(".pagination");

    if (Array.isArray(data) && data.length > 0) {
        const totalPages = Math.ceil(data.length / params.rowsLimit);

        tableHead.innerHTML = "";
        tableBody.innerHTML = "";
        pagination.innerHTML = "";
        table.classList.remove("hide");
        pagination.classList.remove("hide");
        container.style.minHeight = "850px";

        (function fillTable() {
            let startTrim = (activePage - 1) * params.rowsLimit;
            let endTrim = startTrim + params.rowsLimit;
            let trimmedData = data.slice(startTrim, endTrim);

            params.tableHeadRender(tableHead);
            for (let i = 0; i < trimmedData.length; i++) {
                const userData = trimmedData[i];
                params.tableBodyRender(tableBody, userData);
            }
        } ());

        if (totalPages > 1){

            (function buildPages() {
                let leftStep = activePage - Math.floor(params.pagesLimit / 2);
                let rightStep = activePage + Math.floor(params.pagesLimit / 2);

                if (leftStep < 1){
                    leftStep = 1;
                    rightStep = params.pagesLimit;
                }

                if (rightStep > totalPages){
                    leftStep = totalPages - (params.pagesLimit - 1);
                    rightStep = totalPages;
                    if (leftStep < 1) {
                        leftStep = 1;
                    }
                }

                if (totalPages > 2) {
                    let firstButtonHTML = `<button class="pagination__button arrow arrow_first"><i class="fa-solid fa-angles-left"></i></button>`;
                    pagination.innerHTML += firstButtonHTML;
                }

                let prevButtonHTML = `<button class="pagination__button arrow arrow_prev"><i class="fa-solid fa-angle-left"></i></button>`;
                pagination.innerHTML += prevButtonHTML;

                for (let i = leftStep; i <= rightStep; i++) {
                    if (i === activePage){
                        let pageHTML = `<button class="pagination__button page page_active">${i}</button>`;
                        pagination.innerHTML += pageHTML;
                    } else {
                        let pageHTML = `<button class="pagination__button page">${i}</button>`;
                        pagination.innerHTML += pageHTML;
                    }
                }
                let nextButtonHTML = `<button class="pagination__button arrow arrow_next"><i class="fa-solid fa-angle-right"></i></button>`;
                pagination.innerHTML += nextButtonHTML;

                if (totalPages > 2) {
                    let lastButtonHTML = `<button class="pagination__button arrow arrow_last"><i class="fa-solid fa-angles-right"></i></button>`;
                    pagination.innerHTML += lastButtonHTML;
                }
            }());

            (function navigatePages() {
                let pages = document.querySelectorAll(".pagination__button");
                pages.forEach((page) => {
                    page.addEventListener("click", (e) => {
                        e.preventDefault();
                        clearAllMessages();

                        if (page.classList.contains("arrow")){
                            if (page.classList.contains("arrow_first") && activePage !== 1){
                                activePage = 1;
                            } else if (page.classList.contains("arrow_prev") && activePage !== 1){
                                activePage = activePage - 1;
                            } else if (page.classList.contains("arrow_next") && activePage !== totalPages){
                                activePage = activePage + 1;
                            } else if (page.classList.contains("arrow_last") && activePage !== totalPages){
                                activePage = totalPages;
                            }
                        } else {
                            activePage = parseInt(page.innerText);
                        }
                        paginate(table, data, params, activePage);
                    });
                });
            }());
        }
    } else {
        table.classList.add("hide");
        pagination.classList.add("hide");
        container.style.minHeight = "0";
        showMessage(false, "Nothing was found");
    }
}

