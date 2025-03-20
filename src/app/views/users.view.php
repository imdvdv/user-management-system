<div class="container container_users">
    <div>
        <div class="top-panel">
            <div class="top-panel_buttons buttons">
                <a href="<?= BASE_URL . '/users' ?>" class="form__button form__button_refresh button">Refresh</a>
                <a href="<?= BASE_URL . '/popup/search-user' ?>"
                    class="form__button form__button_search-user button">Search</a>
                <a href="<?= BASE_URL . '/popup/add-user' ?>" class="form__button form__button_add-user button">Add</a>
            </div>
        </div>
        <?= $message_banner ?? ''; ?>
        <?php if (is_array($users ?? null)): ?>
            <table class="table table_users">
                <thead class="table__head">
                    <tr class="table__row table__row_head">
                        <th class="table__head-cell table__head-cell_id">ID</th>
                        <th class="table__head-cell table__head-cell_name">Name</th>
                        <th class="table__head-cell table__head-cell_email">Email</th>
                        <th class="table__head-cell table__head-cell_actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="table__body">
                    <?php foreach ($users as $user): ?>
                        <tr class="table__row table__row_user">
                            <td class="table__body-cell table__body-cell_id"><?= htmlspecialchars($user['id']) ?></td>
                            <td class="table__body-cell table__body-cell_name"><?= htmlspecialchars($user['name']) ?></td>
                            <td class="table__body-cell table__body-cell_email"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="table__body-cell table__body-cell_actions">
                                <div class="table__buttons buttons">
                                    <a href="<?= BASE_URL . '/popup/edit-user/' . htmlspecialchars($user['id']) ?>"
                                        class="table__button button table__button_edit">Edit</a>
                                    <a href="<?= BASE_URL . '/popup/delete-user/' . htmlspecialchars($user['id']) ?>"
                                        class="table__button button button_delete">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
    <?= $pagination ?? '' ?>
</div>
<?= $popup ?? '' ?>