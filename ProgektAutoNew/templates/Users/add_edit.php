<?php
use W1020\HTML\Select;

?>
<div class="container">
    <div class="row">
        <div class="col">

        </div>
        <div class="col">
            <form action="<?= $this->data['action'] ?>" method="post">
                <?php
                foreach ($this->data["comments"] as $field => $value) {
                    echo $value . "<br>";
                    if ($field == "user_groups_id") {
                        echo (new Select())
                                ->setName($field)
                                ->setData($this->data["groupList"])
                                ->setSelected($this->data["row"]['user_groups_id'] ?? "")
                                ->html() . '<br>'.'<br>';

                    } else {
                        echo "<input class='form-control form-group' name='$field' value='" . ($this->data['row'][$field] ?? "") . "'><br>";
                    }
                }
                ?>
                <input type="submit" value="ok" class="btn btn-primary">
            </form>

        </div>
        <div class="col">

        </div>
    </div>
</div>
