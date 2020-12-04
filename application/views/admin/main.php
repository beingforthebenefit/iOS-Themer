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
                    <?= $admin['lastLogin'] ?? 'Never' ?>
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
                # of Calls
            </th>
            <th>
                Active
            </th>
            <th>
                Toggle
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
                    <?= $key['timesUsed'] ?>
                </td>
                <td>
                    <?= $key['active'] ? 'Yes' : 'No' ?>
                </td>
                <td>
                    <a href="#" title="Toggle" alt="Toggle" onclick="confirmToggle('<?= $key['key'] ?>', '<?= $key['owner'] ?>')">
                        <?= $key['active'] ? '🚫' : '✔️' ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="#" title="Add Key" alt="Add Key" onclick="addKey()">
        ➕
    </a>
</div>
<script>
    function confirmToggle(key, owner) {
        var sure = confirm("Are sure you want to toggle the API key belonging to " + owner + "?");
        if (sure) {
            window.location.replace("/?p=admin&a=toggleKey&key=" + key);
        }
    }

    function addKey() {
        var owner = prompt('Please enter owner\'s name');
        if (owner != null) {
            window.location.replace("/?p=admin&a=addKey&owner=" + owner);
        } else {
            alert('You must enter a name');
        }
    }
</script>