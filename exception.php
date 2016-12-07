<?php

class UserIdentity
{

    public function findById($id)
    {
        $id = intval($id);
        if (empty($id)) {
            throw new InvalidArgumentException('User ID cannot be blank');
        }

        // поиск пользователя
    }
}

$user = new UserIdentity;
$user->findById('asd123');
