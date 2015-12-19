<?php

namespace app\models\Form;

use app\models\NewsItem;
use app\models\User;
use app\services\GsssHtml;
use cs\services\Security;
use cs\services\Str;
use cs\services\UploadFolderDispatcher;
use cs\services\Url;
use cs\services\VarDumper;
use Yii;
use yii\base\Model;
use cs\Widget\FileUpload2\FileUpload;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * ContactForm is the model behind the contact form.
 */
class Upload extends Model
{
    public $file;

    public function rules()
    {
        return [
            ['file','file']
        ];
    }

    public function action()
    {
        $file = UploadedFile::getInstance($this, 'file');
        $path = UploadFolderDispatcher::createFolder('tempFiles');
        $f = explode('.', $file->name);
        if (count($f) == 1) {
            $ext = 'jpg';
        } else {
            $ext = $f[count($f)-1];
        }
        $path->add(time() . '_' . Security::generateRandomString().'.'.$ext);
        $file->saveAs($path->getPathFull());
        Yii::$app->session->setFlash('fileName', $path->getPath());

        return true;
    }

}
