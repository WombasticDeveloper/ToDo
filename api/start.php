<body>
    <form method="POST">
        <input type='checkbox' name='c'>
        <input type='submit'>
    </form>
</body>
<?php
    echo password_hash('',PASSWORD_DEFAULT)
?>