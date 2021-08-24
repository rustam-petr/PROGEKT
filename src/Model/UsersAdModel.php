<?php

namespace App\Model;

use W1020\Table as ORMTable;

class UsersAdModel extends ORMTable
{
    protected int $userId;

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId(int $userId): static
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param int $page
     * @return array<array>
     * @throws \Exception
     */
    public function getPage(int $page = 1): array
    {
        $sql = <<<SQL
SELECT
    `ad`.`id`,
    `marka_auto`.name AS 'marka_auto_id',
    `ad`.`year`,
    `ad`.`engine`,
    `ad`.`price`,
    `users`.`name` AS 'users_id'
    
FROM
    `users`,
    `ad`,
    `marka_auto`
WHERE
    `ad`.`marka_auto_id` = `marka_auto`.`id` and  `users`.`id` = `ad`.`users_id` and `users`.`id` = $this->userId
SQL;

        return $this->query(
            "$sql LIMIT " . (($page - 1) * $this->pageSize) . ",$this->pageSize;"
        );
    }

    public function rowCount(): int
    {
        return $this->query("SELECT COUNT(*) as COUNT FROM `$this->tableName` WHERE `users_id` = $this->userId")[0]["COUNT"];
    }


    public function getGroupList()
    {
        $data = $this->query("SELECT `id`,`name` FROM `user_groups`");
        $arr = [];
        foreach ($data as $row) {
            $arr[$row['id']] = $row['name'];
        }
        return $arr;
    }

    public function getMarka()
    {
        $data = $this->query("SELECT `id`,`name` FROM `marka_auto`");
        $arr = [];
        foreach ($data as $row) {
            $arr[$row['id']] = $row['name'];
        }
        return $arr;

    }

    public function getNameList()
    {
        $data = $this->query("SELECT `id`,`name` FROM `users` WHERE `user_groups_id`=3");
        $arr = [];
        foreach ($data as $row) {
            $arr[$row['id']] = $row['name'];
        }
        return $arr;

    }

}