<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\BadRequestHttpException;


/**
 * Edit User Profile
 */
class EditAccount extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmpassword;
    public $address;
    public $bank_name;
    public $bvn;
    public $phone;
    public $account_name;
    public $account_number;
    public $passport;
    public $recipient_code;
    public $agent;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username','match','not'=>true,'pattern'=>'/[^a-z A-Z 0-9 @ . - + \s]/','message'=>'Contains Invalid Characters'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.','when'=> function($model){
                return $model->username != Yii::$app->user->identity->username;
            }],
            ['username', 'string', 'min' => 2, 'max' => 255],            

            ['password', 'string', 'min' => 6],

            ['confirmpassword','compare','compareAttribute' => 'password','message'=>'Passwords dont match'],

           // ['address', 'required'],
            ['address', 'string','min' => 10, 'max' => 1500 ,'message'=>'lenth of address is wrong'],
            ['address','match','not'=>true,'pattern'=>'/[^a-z A-Z 0-9 @ . , - \s]/','message'=>'Contains Invalid Characters'],

            ['agent', 'required'],
            ['agent', 'string'],

            ['bvn', 'required'],
            ['bvn', 'string'],

            ['phone', 'required'],
            ['phone', 'string'],


            ['email', 'required'],
            ['email', 'string'],

          //  ['bank_name', 'required'],
            ['bank_name', 'string','min' => 2, 'max' => 255 ,'message'=>'Select a Bank'],
            ['bank_name','match','not'=>true,'pattern'=>'/[^a-z A-Z 0-9 \s]/','message'=>'Contains Invalid Characters'],

          //  ['account_name', 'required'],
            ['account_name', 'string','min' => 5, 'max' => 255 ,'message'=>'lenth of account name is wrong'],
            ['account_name','match','not'=>true,'pattern'=>'/[^a-z A-Z 0-9 @ . - \s]/','message'=>'Contains Invalid Characters'],

           // ['account_number', 'required'],
            ['account_number', 'string', 'min' => 10, 'max' => 10 ,'message'=>'Invalid account number'],
            ['account_number','match','not'=>true,'pattern'=>'/[^ 0-9 \s]/','message'=>'Contains Invalid Characters'],
           // [['account_number'], 'validatebank'],
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
              "app"=>"Validate Bank Details"
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
     * edit user profile.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function editprofile()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = User::findByUsername(Yii::$app->user->identity->username);
        $user->username = $this->username;
        if(!empty($this->password)){
          $user->setPassword($this->password);
        }
        $user->address=$this->address;
        $user->bank_name=$this->bank_name;
        $user->account_name=$this->account_name;
        $user->account_number=$this->account_number;
        $user->bvn=$this->bvn;
        $user->phone=$this->phone;
        $user->is_agent=$this->agent;
        $user->email=$this->email;

        return $user->save() ? $user : null;
    }
}
