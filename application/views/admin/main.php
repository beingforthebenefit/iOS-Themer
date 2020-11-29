<div>
    <h1>Admins</h1>
    <table>
        <tr>
            <th>
                Username
            </th>
            <th>
                Last login
            </th>
        </tr>
        <?php foreach ((new AdminModel('admins'))->rows() as $admin) { ?>
            <tr>
                <td>
                    <?= $admin['username'] ?>
                </td>
                <td>
                    <?= $admin['lastLogin'] ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<div>
    <h1>API Keys</h1>
    <table>
        <tr>
            <th>
                Key
            </th>
            <th>
                Owner
            </th>
            <th>
                Created
            </th>
            <th>
                Expires
            </th>
        </tr>
        <?php foreach ((new ApiKeyModel('apiKeys'))->rows() as $key) { ?>
            <tr>
                <td>
                    <?= $key['key'] ?>
                </td>
                <td>
                    <?= $key['owner'] ?>
                </td>
                <td>
                    <?= $key['dateCreated'] ?>
                </td>
                <td>
                    <?= $key['dateExpires'] ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>