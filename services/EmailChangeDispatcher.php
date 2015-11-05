<?php


namespace app\services;

use \yii\db\Query;

class EmailChangeDispatcher extends \cs\services\dispatcher\EmailChange
{
    const TABLE = 'cap_users_email_change';
}