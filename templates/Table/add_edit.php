<form action="<?= $this->data['action'] ?>" method="post">
    <?php
    foreach ($this->data["comments"] as $field => $value) {
        echo $value . "<br>";
        echo "<input name='$field' value='" . ($this->data['row'][$field] ?? "") . "'><br>";
    }
    ?>
    <input type="submit" value="ok" class="btn btn-primary">
</form>
