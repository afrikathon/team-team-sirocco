<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\BadRequestHttpException;


/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $phone;
    public $password;
    PUBLIC $bvn;
    public $confirmpassword;
    public $account_type;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username','match','not'=>true,'pattern'=>'/[^a-z A-Z 0-9 @ . - \s]/','message'=>'Contains Invalid Characters'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['account_type', 'required'],
            ['email', 'required'],
            ['email', 'email'],

           // ['bvn', 'string','max' => 10],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'max' => 15],
            ['phone','match','not'=>true,'pattern'=>'/[^0-9 + -\s]/','message'=>'Contains Invalid Characters'],
           // ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This phone number has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['confirmpassword', 'required'],
            ['confirmpassword', 'compare','compareAttribute' => 'password','message'=>'Passwords dont match'],

        ];
    }


    public function validatebank($attribute, $params)
    {
        $data=[
           "type"=>"nuban",
           "name"=>$this->username,
           "description"=>"transfer recipient creation",
           "account_number"=>$this->account_number,
           "bank_code"=> $this->bank_name,
           "currency"=>"NGN",
           "metadata"=> [
              "app"=>"Wondemor signup"
            ]
        ];
        $result=User::sendpost('https://api.paystack.co/transferrecipient',$data);

        if ($result['status']==false) {
            $this->addError($attribute,"Invalid Bank Account Details");        
        }else{
            $this->recipient_code=$result['data']['recipient_code'];
        }
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->email= $this->email;
        $user->account_type = $this->account_type;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return ($user->save()) ? $user : null;
    }

    /**
     * Sends an email with a link, for confirming account.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'username' => $this->username,
        ]);

        if (!$user) {
           return false;
        }
        $user->generateConfirmAccountToken();
        if (!$user->save()) {
                return false;
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'accountConfirmToken-html', 'text' => 'accountConfirmToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account Confirmation for ' . Yii::$app->name)
            ->send();
    }
}
