<?php


namespace app\services;

use app\models\SiteContentInterface;
use app\models\SubscribeMailItem;
use app\models\User;
use cs\services\VarDumper;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class Subscribe
{
    const TYPE_NEWS        = 1;
    const TYPE_SITE_UPDATE = 2;
    const TYPE_MANUAL      = 3;

    /** @var array Список полей для хранения информации о типах подписки */
    public static $userFieldList = [
        'subscribe_is_site_update',
        'subscribe_is_news',
        'subscribe_is_tesla',
    ];


    /**
     * Добавляет записи для рассылки в таблицу рассылки
     *
     * @param SiteContentInterface | \app\models\SubscribeItem $item тема письма
     */
    public static function add($item)
    {
        if ($item instanceof SiteContentInterface) {
            $subscribeItem = $item->getMailContent();
        } else {
            $subscribeItem = $item;
        }
        switch ($subscribeItem->type) {
            case self::TYPE_NEWS:
                $where = ['subscribe_is_news' => 1];
                break;
            case self::TYPE_SITE_UPDATE:
                $where = ['subscribe_is_site_update' => 1];
                break;
            case self::TYPE_MANUAL:
                $where = ['subscribe_is_tesla' => 1];
//                $where = ['subscribe_is_test' => 1];
                break;
        }

        $emailList = User::query($where)
        ->select('email')
        ->andWhere(['not', ['email' => null]])
        ->andWhere(['not', ['email' => '']])
        ->andWhere([
            'is_active'  => 1,
//            'is_confirm' => 1,
        ])
        ->column();

//        VarDumper::dump(count($emailList),3,false);exit;

        $rows = [];
        foreach ($emailList as $email) {
            $urlUnSubscribe = Url::to(['subscribe/unsubscribe', 'mail' => $email, 'type' => $subscribeItem->type, 'hash' => self::hashGenerate($email, $subscribeItem->type)], true);
            SubscribeMailItem::insert([
                'text'        => str_replace('{linkUnsubscribe}', $urlUnSubscribe, $subscribeItem->text),
                'html'        => str_replace('{linkUnsubscribe}', $urlUnSubscribe, $subscribeItem->html),
                'subject'     => $subscribeItem->subject,
                'mail'        => $email,
                'date_insert' => time(),
            ]);
            $rows[] = $email;
        }
        \Yii::info($rows, 'tg\\subscribe');
    }

    /**
     * Генерирует hash для ссылки отписки
     *
     * @param string  $email почта клиента
     * @param integer $type  имп рассылки \app\services\Subscribe::TYPE_*
     *
     * @return string
     *
     */
    public static function hashGenerate($email, $type)
    {
        return md5($email . '_' . $type);
    }

    /**
     * Проверяет hash для ссылки отписки
     *
     * @param string  $email почта клиента
     * @param integer $type  имп рассылки \app\services\Subscribe::TYPE_*
     * @param integer $hash
     *
     * @return boolean
     * true - верный
     * false - не верный
     */
    public static function hashValidate($email, $type, $hash)
    {
        return md5($email . '_' . $type) == $hash;
    }
}