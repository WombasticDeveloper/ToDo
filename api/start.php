<body>
    <form method="POST">
        <input type='checkbox' name='c'>
        <input type='submit'>
    </form>
</body>
<?php
    echo date("Y-m-d G:i:s", strtotime("now"));
?>