<!DOCTYPE html>
<html>
<?php require_once __DIR__ . "/components/head.html";?>
<body>
<div class="container container_users">
    <div class="top-panel">
        <div class="top-panel__buttons">
            <button class="top-panel__button top-panel__button_refresh">Refresh</button>
            <button type="button" class="top-panel__button top-panel__button_add-user">Add +</button>
        </div>
        <div class="top-panel__search-bar">
            <input type="text" class="top-panel__search-line" placeholder="Enter ID, Email or Username">
            <i class="top-panel__clear-icon fa-solid fa-xmark"></i>
            <button type="button" class="top-panel__button top-panel__button_search-bar"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
    <div class="message">
        <p class="message-text"></p>
    </div>
    <table class="table table_users">
        <thead class="table__head">
        </thead>
        <tbody class="table__body">
        </tbody>
    </table>
    <div class="pagination">
    </div>
</div>
<?php include_once __DIR__ . "/components/popup/popup-layout.html";?>
<?php include_once __DIR__ . "/components/scripts.html";?>
</body>
</html>