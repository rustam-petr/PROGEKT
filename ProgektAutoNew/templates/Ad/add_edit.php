<?php

use W1020\HTML\Select;

?>

<form action="<?= $this->data['action'] ?>" method="post">
    <?php
    foreach ($this->data["comments"] as $field => $value) {
        if ($field == 'marka_auto_id') {
            echo $value . "<br>";
            echo (new Select())
                    ->setName($field)
                    ->setData($this->data["markaList"])
                    ->setSelected($this->data["row"]['marka_auto_id'] ?? "")
                    ->html() . '<br>';

        } elseif ($field == 'users_id') {
//            echo "<input type='hidden' name='$field' value='" . ($_SESSION['user']['id']) . "'>";

//            echo (new Select())
//                    ->setName($field)
//                    ->setData($this->data["loginList"])
//                    ->setSelected($this->data["row"]['users_id'] ?? "")
//                    ->html() . '<br>';

        } else {
            echo $value . "<br>";
            echo "<input name='$field' value='" . ($this->data['row'][$field] ?? "") . "'><br>";

        }
    }
    ?>
    <input type="submit" value="ok" class="btn btn-primary">
</form>
