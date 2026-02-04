<?php
print_r($_SESSION['CSRF-token'])
?>
<main>
    <form action="/roles" method="post">
        <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
        <input type="text" name="name" placeholder="Create new role">
        <button type="submit">submit</button>
    </form>

    <br>

    <table border="1">
        <thead>
            <tr>
                <td>ID</td>
                <td>NAME</td>
                <td>EDIT</td>
                <td>DELETE</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?= htmlspecialchars($role->getId()) ?></td>
                    <td><?= htmlspecialchars($role->getName()) ?></td>
                    <td><a href="">Edit</a></td>
                    <td>
                        <form action="/roles/<?= $role->getId() ?>" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>