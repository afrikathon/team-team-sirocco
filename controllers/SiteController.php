<?php
namespace frontend\controllers;

use frontend\models\Products;
use frontend\models\Profile;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\EditAccount;
use frontend\models\Accounts;
use frontend\models\Accountssearch;
use frontend\models\Plans;
use frontend\models\Referral;
use frontend\models\PaymentPage;
use frontend\models\Transaction;
use frontend\models\Transactionsearch;
use frontend\models\Rating;
use common\models\User;
use frontend\models\Payout;
use frontend\models\Jobs;
use frontend\models\Jobssearch;
use frontend\models\Subscription;
use frontend\models\Subscriptionsearch;
use backend\models\Chatsearch;
use backend\models\Chat;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'login','error','confirm-account','request-password-reset','reset-password','ussd','ussdd','pay','verifytransaction'],
                        'allow' => true,
                    ], 
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ], 
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        if(!Yii::$app->user->isGuest){
            $this->layout = 'main3';
        }
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main1';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/talentocean');
        }
        return $this->redirect('/talentocean');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'main2';

        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->account_type=="talent"){
                return $this->redirect(['profile/talent']);
            }else{
                return $this->redirect(['profile/index']);
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->account_type=="talent"){
                return $this->redirect(['profile/talent']);
            }else{
                return $this->redirect(['profile/index']);
            }
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($id=null)
    {
        $this->layout = 'main2';


        if(!Yii::$app->user->isGuest){
            Yii::$app->user->logout();
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if($id!=null){
                    $referralUser = Profile::find()->where(['user_id'=>$id])->one();
                    $newReferral = new Referral();
                    $newReferral->user_id=$referralUser->user_id;
                    $newReferral->referral_name=$model->username;
                    $newReferral->save(false);
                    $referralUser->points+=Profile::POINT_FOR_NEW_REFERRAL;
                    $referralUser->save(false);
                }
                if (Yii::$app->getUser()->login($user)) {
                    
                }
            Yii::$app->session->setFlash('success', 'Account created, Welcome to Talent Ocean');
            return $this->redirect(['site/login']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Edit user up.
     *
     * @return mixed
     */
    public function actionEditAccount()
    {
        $model = new EditAccount();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->editprofile()) {
                Yii::$app->session->setFlash('success', 'Your changes have been saved'); 
                return $this->redirect(['site/edit-account']);
            }else{
                Yii::$app->session->setFlash('warning', 'Changes made were not saved');                 
            }
        }
        $model->username=Yii::$app->user->identity->username;
        $model->email=Yii::$app->user->identity->email;
        $model->agent=Yii::$app->user->identity->is_agent;
        $model->bvn=Yii::$app->user->identity->bvn;
        $model->phone=Yii::$app->user->identity->phone;
        $model->account_number=Yii::$app->user->identity->account_number;
        $model->bank_name=Yii::$app->user->identity->bank_name;
        $model->account_name=Yii::$app->user->identity->account_name;
        $model->address=Yii::$app->user->identity->address;
        return $this->render('editaccount', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'main4';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

            return $this->redirect(['site/login']);
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'main4';
        if (self::check_non_mixed($token)) {
            Yii::$app->session->setFlash('danger', 'At Wondemor security is a priority, You can only try.....We are watching');
            return $this->redirect(['site/login']);
        }else{
            try {
                $model = new ResetPasswordForm($token);
            } catch (InvalidParamException $e) {
                Yii::$app->session->setFlash('error', 'Invalid password reset token...Request a new one');
                return $this->redirect(['site/request-password-reset']);
            }

            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                Yii::$app->session->setFlash('success', 'New password saved.....');

                return $this->redirect(['site/login']);
            }

            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }
    }

    public function actionConfirmAccount($token)
    {
        if (self::check_non_mixed($token)) {
            Yii::$app->session->setFlash('danger', 'At Wondemor security is a priority, You can only try.....We are watching');
            return $this->redirect(['site/login']);
        }else{
            try {
                if (empty($token) || !is_string($token)) {
                    throw new InvalidParamException('Confirm Account token cannot be blank.');
                }
                $user = User::findByConfirmAccountToken($token);
                if (!$user) {
                    throw new InvalidParamException('Invalid Account token.');
                }
            } catch (InvalidParamException $e) {
                Yii::$app->session->setFlash('error', 'Invalid Account Confirmation token.');
                return $this->redirect(['site/login']);
            }

            $user->status=10;
            $user->account_confirm_token=null;

            if ($user->save(false)) {
                Yii::$app->session->setFlash('success', 'Your account has been confirmed.');

                return $this->redirect(['site/login']);
            }
            return $this->redirect(['site/login']);
        }
    }

    public function actionConfirmPayout($token)
    {
        if (self::check_non_mixed($token)) {
            Yii::$app->session->setFlash('danger', 'At Wondemor security is a priority, You can only try.....We are watching');
            return $this->redirect(['site/dashboard']);
        }else{
            try {
                if (empty($token) || !is_string($token)) {
                    throw new InvalidParamException('Confirm Payment token cannot be blank.');
                }
                $payout = Payout::findByConfirmPaymentToken($token);
                if (!$payout) {
                    throw new InvalidParamException('Invalid Payment Approval token.');
                }
                $account=Accounts::find()->where(['account_reference'=>$payout->account_reference,'status'=>'active'])->one();
                if( $account == null){
                    throw new InvalidParamException('This account is not valid for payout.');
                }
            } catch (InvalidParamException $e) {
                Yii::$app->session->setFlash('error', 'Invalid Payment Approval token.');
                return $this->redirect(['site/dashboard']);
            }

            $payout->status="approved";
            if ($payout->save()) {
                $amount_in_kobo=$payout->amount * 100;
                $data=[
                    'source'=>'balance',
                    'amount'=>$amount_in_kobo,
                    'recipient'=>$payout->recipient_code,
                    'reference'=>$payout->reference,
                    'reason'=>'Payout from Wondemor',
                ];
                $result=User::sendpost('https://api.paystack.co/transfer',$data);
                if(array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] == 'success')){
                    $payout->status="paid";
                    $payout->paid_time=date('Y-m-d h:i:s');
                    $payout->payout_attempt+=1;
                    $payout->confirm_token=null;
                    $payout->save();
                    $account->status="paid";
                    $account->save();
                    Yii::$app->session->setFlash('success', 'You have successfully approved your payout request. You will receive payment soon.');
                }else{
                    $payout->reference=$payout->getref(10);
                    $payout->save();
                    Yii::$app->session->setFlash('warning', 'Error occurred while processing your request contact support...');
                }

            }else{
                Yii::$app->session->setFlash('warning', 'Error occurred while processing your request contact support..');
            }
            return $this->redirect(['site/dashboard']);
        }
    }

    /**
     * Dashboard
     *
     * @return mixed
     */
    public function actionDashboard()
    {
        $this->layout = 'main3';

         //return $this->redirect(['site/login']);
        $userid=Yii::$app->user->identity->id;
        $model = Subscription::find()->where("customer_id=$userid and status='active'")->limit(4)->orderBy(['id'=>SORT_DESC])->all();

        return $this->render('dashboard', ['model'=>$model]);
    }

    /**
     * Dashboard
     *
     * @return mixed
     */
    public function actionAccounthistory()
    {
        $this->layout = 'main3';

        $userid=Yii::$app->user->id;
        $model = Subscription::find()->where("customer_id=$userid")->orderBy(['id'=>SORT_DESC])->all();
        $model_4 = Subscription::find()->where("customer_id=$userid and status='active'")->limit(4)->orderBy(['id'=>SORT_DESC])->all();

        return $this->render('accounthistory', ['model'=>$model,'model_4'=>$model_4]);
    }
    /**
     * Withdraw
     *
     * @return mixed
     */
    public function actionWithdraw()
    {

        $this->layout = 'main3';

        $searchModel = new Accountssearch();
        $dataProvider = $searchModel->searchforwithdraw(Yii::$app->request->queryParams,Yii::$app->user->id);

        return $this->render('withdraw', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTransactionhistory()
    {

        $this->layout = 'main3';

        $searchModel = new Jobssearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->user->id);

        return $this->render('jobslist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Support chat view action.
     *
     * @return string
     */
    public function actionSupport()
    {
        $this->layout = 'main3';


        if (!Yii::$app->user->isGuest) {
            $sql="UPDATE chat SET seen=1 WHERE sent_from='support' and user_id=".Yii::$app->user->id;
            Yii::$app->db->createCommand($sql)->execute();  
            $model = new Chat();
            $searchModel = new Chatsearch();
            $dataProvider = new ActiveDataProvider(['query'=>Chat::find()->where(['user_id'=>Yii::$app->user->id])->orderBy('time DESC'),
            'pagination' => [
                    'pageSize' => 7,
                ],        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->user_id=Yii::$app->user->id;
            $model->sent_to="support";
            $model->sent_from=Yii::$app->user->identity->username;
            $model->time = time();
            $model->rfc822 = date(DATE_RFC822,$model->time);
            $model->save();
            $model = new Chat();
        }

            return $this->render('support', [
                'model'=>$model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * user selects a plan
     *
     * @return mixed
     */
    public function actionSelectplan($plan)
    {
        $model = new Subscription();
        $model3= new Products();
        if ($model->load(Yii::$app->request->post())) {
            $company_id=$_POST["Subscription"]["company_name"];
            $product_code=$_POST["Products"]["code"];
            $product=Products::findOne($product_code);
            $company=User::findOne($company_id);
            $model2 = new Subscription();
            $model2->amount =$product->amount;
            $model2->insurance_type =$product->type;
            $model2->customer_id =Yii::$app->user->identity->id;
            $model2->customer_name =Yii::$app->user->identity->username;
            $model2->company_id =$company->id;
            $model2->company_name =$company->username;
            $model2->insurance_code=User::getref(10);
            $model2->status="active";
            self::charge_purse(Yii::$app->user->identity->id,$company->id,$product->amount);
            if($model2->save(false)){
                Yii::$app->session->setFlash('success', 'Your Insurance package purchase was successful ..');
                return $this->redirect(['site/dashboard']);
            }
        }
        return $this->renderAjax('selectplan', ['plan'=>$plan,'model'=>$model,'model2'=>$model3]);
    }


    public function actionCompany($id,$type)
    {
        $products=Products::find()->where(['company_id'=>$id,'type'=>$type])->all();
        foreach ($products as $product){
            echo "<option value='".$product->id."'>".$product->code."</option>";
        }
        echo "<h4>worked fine</h4>";
    }

    public function actionCode($id)
    {
        $products=Products::find()->where(['id'=>$id])->one();
        echo "<h4>Product Code : $products->code</h4><h4>Product Cost : ₦$products->amount</h4><h4>Product Description : $products->description</h4>";
    }

    public function actionPaywondemor($reference)
    {
        if (self::check_non_mixed($reference)) {
            Yii::$app->session->setFlash('danger', 'At Wondemor security is a priority, You can only try.....We are watching');
            return $this->redirect(['site/dashboard']);
        }else{
            $result=User::sendget('https://api.paystack.co/transaction/verify/',$reference);
            if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
                $user_id=Yii::$app->user->id;
                $account=Accounts::find()->where ("user_id = $user_id and account_reference = '$reference'")->one();
                $account->status="active";
                $account->date_opened=date('Y-m-d h:i:s');
                $date_opened=$account->date_opened;
                $days=$account->days;
                $account->date_due = date('Y-m-d h:i:s',strtotime("+$days days", strtotime($date_opened)));
                $account->save();
                Yii::$app->session->setFlash('success', 'Payment for your plan have been confirmed...');
                return $this->redirect(['site/dashboard']);

            }else{
                Yii::$app->session->setFlash('danger', 'Fraud detected you risk your account been blocked...');
            }
            return $this->redirect(['site/dashboard']);
        }
    }

    public function actionPayout($id)
    {
        if (self::check_non_integer($id)) {
            Yii::$app->session->setFlash('danger', 'At Wondemor security is a priority, You can only try.....We are watching');
            return $this->redirect(['site/dashboard']);
        }else{
            $user_id=Yii::$app->user->id;
            $model=Accounts::find()->where("user_id=$user_id and id = $id and status = 'active'")->one();
            if($model){
                $paymodel=new Payout();
                $paymodel->user_id=$user_id;
                $paymodel->status="processing";
                $paymodel->recipient_code=Yii::$app->user->identity->recipient_code;
                $due_date_value=strtotime($model->date_due);
                $current_time=strtotime(date('Y-m-d h:i:s'));
                if($due_date_value <= $current_time){
                    $paymodel->amount=$model->payout;
                }else{
                    $paymodel->amount=$model->amount;
                }
                $paymodel->request_time=date('Y-m-d h:i:s');
                $paymodel->reference=$paymodel->getref(10);
                $paymodel->confirm_token=$model->getref(15);
                $paymodel->account_reference=$model->account_reference;
                if($paymodel->save() && $model->save()){
                    $paymodel->sendEmail($paymodel->id);
                    Yii::$app->session->setFlash('success', 'Please check your email to grant approval for your payout...');
                }
            }else{
                Yii::$app->session->setFlash('danger', 'Fraud detected you risk your account been blocked...'); 
                 }
            return $this->redirect(['site/withdraw']);
        }
    }

    public function calculatepayout($description,$amount)
    {
        $model=Plans::find()->where ("amount_from <= $amount and amount_to >= $amount and description='$description'")->one();
        if($model==null){
            return null;
        }
        $payout=(int)(($amount*$model->rate) + $amount);
        return $payout;
    }


    public function actionFundwallet(){
        $model = new Transaction();
        if ($model->load(Yii::$app->request->post())) {
            $model->phone = Yii::$app->user->identity->phone;
            $model->transaction_from = "your bank";
            $model->transaction_to = "your wallet";
            $model->type = "bank to purse";
            $model->description = "funding my Talent Ocean purse";
            $model->transaction_reference = User::getref(10);
            $model->status = 'successful';
            $model->save();
            $user = User::findOne(Yii::$app->user->identity->id);
            $user->purse += $model->amount;
            $user->save();
            Yii::$app->session->setFlash('success', 'You have successfully funded your wallet...');
            return $this->redirect(['site/dashboard']);
        }
        return $this->render('fundwallet',['model'=>$model]);
    }

    public function actionPay($page_id){
        $model = new Transaction();
        $page = PaymentPage::find()->where(['page_id'=>$page_id])->one();
        if ($model->load(Yii::$app->request->post())) {
            $model->phone=$page->phone;
            $model->transaction_from = "customers";
            $model->transaction_to = "your wallet";
            $model->type = "payment page";
            $model->description="funding my wallet from payment page";
            $model->transaction_reference=User::getref(10);
            $model->status='pending';
            if ($model->save()) {
                $amount_in_kobo= $model->amount * 100;
                $data=[
                    'email'=>'olabamsg@gmail.com',
                    'amount'=>$amount_in_kobo,
                    'reference'=>$model->transaction_reference,
                    //fully qualified url to payment verification action (paywondemor)
                    //'callback_url'=>'http://bla bla bla',
                ];
                $result=User::sendpost('https://api.paystack.co/transaction/initialize',$data);
                if($result != null){
                    return $this->redirect($result['data']['authorization_url']);
                }else{
                    Yii::$app->session->setFlash('warning', 'System Error while processing your request...');
                    return $this->render('pay',['model'=>$model,'page'=>$page]);
                }
            }
        }
        return $this->render('pay',['model'=>$model,'page'=>$page]);
    }

    public function actionVerifytransaction($reference)
    {
        if (self::check_non_mixed($reference)) {
            Yii::$app->session->setFlash('danger', 'Invalid Transaction reference token');
            return $this->redirect(['fundwallet']);
        }else{
            $result=User::sendget('https://api.paystack.co/transaction/verify/',$reference);
            if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
                $transact=Transaction::find()->where ("transaction_reference = '$reference' and status ='pending'")->one();
                $transact->status="successful";
                $profile=User::find()->where (['phone'=>$transact->phone])->one();
                $profile->purse += $transact->amount;
                $profile->save(false);
                $transact->save(false);
                Yii::$app->session->setFlash('success', 'Your transaction with reference was successful');
                return $this->redirect(['dashboard']);
            }else{
                Yii::$app->session->setFlash('warning', 'Your transaction with reference  was not successful...');
            }
            return $this->redirect(['dashboard']);
        }
    }

    public function actionTransferpage(){
        //var_dump(self::bank_account_name('2100074589','057'));die();
        //
        return $this->render('transferpage');
    }

    public function actionTransferpurse(){
        $model = new Transaction();
        if ($model->load(Yii::$app->request->post())) {
            $senderphone= Yii::$app->user->identity->phone;;
            $model->transaction_from = "wallet";
            $model->transaction_to = "wallet";
            $model->type = "transfer";
            $model->transaction_reference=User::getref(10);
            if(self::charge_purse($senderphone,$model->phone,$model->amount)){
                $model->status='successful';
                Yii::$app->session->setFlash('success', 'Your transaction was successful...');
            }else{
                $model->status='failed';
                Yii::$app->session->setFlash('warning', 'Your transaction was not successful...');
            }
            $model->phone= $senderphone;
            if ($model->save()) {
                //
            }
            return $this->redirect(['transferpage']);
        }

        return $this->renderAjax('transferpurse', [
            'model' => $model,
        ]);
    }


    public function actionTransferbank(){
        $model = new Transaction();
        if ($model->load(Yii::$app->request->post())) {

        }
        return $this->renderAjax('transferbank',['model'=>$model]);
    }



    public function actionPaymentpages()
    {

        $model = new PaymentPage();

        if ($model->load(Yii::$app->request->post())) {
            $model->phone= Yii::$app->user->identity->phone;
            $model->status= "active";
            $model->page_id = User::getref(6);
            $page_id= $model->page_id;
            $link= "http://www.sirocco.tech/cashbreeze/site/pay?page_id=$page_id";
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Your have successfully created your payment page here   $link");
                return $this->redirect($link);
            }
        }

        return $this->render('paymentpage', [
            'model' => $model,
        ]);
    }


    public function actionRateservice()
    {
        $model = new Rating();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Thanks for your feedback. Ratings successfully added.');      
            }else{
            Yii::$app->session->setFlash('warning', 'Sorry your ratings was not saved, Pls try again later.');            
            }
            return $this->redirect(['jobs/yourjobs']);
        }

        return $this->renderAjax('rateservice', [
            'model' => $model,
        ]);
    }



    public function charge_able($phone,$amount){
        $profile=User::find()->where (['id'=>$phone])->one();
        if($profile){
            if($profile->purse >= $amount){
                return true;
            }
        }
        return false;
    }

    // public function actionChecki() {
    //     // $result= self::charge_able("+2348091760116","8000");
    //     // if($result===true){
    //     //     echo "charge_able number";
    //     // }elseif ($result===0) {
    //     //     echo "Insufficient balance";
    //     // }else{
    //     //     echo "This number is not registered on cashbreeze..";
    //     // }
    //     // self::charge_purse('+2348091760116',"+2348052240517",'2000');
    //     // echo "done";
    // }

    public function charge_purse($phone_from,$phone_to,$amount){
      //  if(self::charge_able($phone_from,$amount) && self::cashbreeze_account_name($phone_to) !== Null){
                $profile_from=User::find()->where (['phone'=>$phone_from])->one();
                $profile_from->purse -= $amount;
                $profile_from->save();
                $profile_to=User::find()->where (['phone'=>$phone_to])->one();
                $profile_to->purse += $amount;
                $profile_to->save();
                return true;
       // }else{
           // return false;
       // }
    }

    public function bank_account_name($bank_account,$bank_code){
            $result=User::sendget("https://api.paystack.co/bank/resolve?account_number=$bank_account&bank_code=$bank_code","");
            if (array_key_exists('status', $result) && ($result['status'] == true)) {

                return $result['data']['account_name'];

            }else{
                return "The account details provided is incorrect.";
            }
    }

    public function cashbreeze_account_name($phone){
        $profile= User::find()->where (['phone'=>$phone])->one();
        return ($profile) ? $profile->username : Null ;
    }


    public function check_non_integer($value){
        $pattern = "/[^ 0-9 \s]/";
        return preg_match($pattern, $value);
    }

    public function check_non_mixed($value){
        $pattern = "/[^a-z A-Z 0-9 _ \s]/";
        return preg_match($pattern, $value);        
    }

    public function actionUssdd()
    {
        $sessionId   = $_POST["sessionId"];
        $serviceCode = $_POST["serviceCode"];
        $phoneNumber = $_POST["phoneNumber"];
        $text        = $_POST["text"];
        if ( $text == "" ) {
            $response = "CON Talent Ocean Linode Monitoring App\n";
            $response .= "1. Check Server Status \n";
            $response .= "2. Reboot Server \n";
            $response .= "3. Shutdown Server\n";
            $response .= "4. Scale Up Server";
        }elseif($text == "1"){
            $result = self::linodeCurlGet("https://api.linode.com/v4/linode/instances/18801649");
            $response = "END " . $result['status'];
        }elseif($text == "2"){
            self::linodeCurlPost("https://api.linode.com/v4/linode/instances/18801649/reboot");
            $response = "END " . "Server is rebooting";
        }elseif($text == "3"){
            self::linodeCurlPost("https://api.linode.com/v4/linode/instances/18801649/shutdown");
            $response = "END " . "Server is shutting down";
        }elseif($text == "4"){
            self::linodeCurlPost("https://api.linode.com/v4/linode/instances/18801649/resize");
            $response = "END " . "Server successfully upgraded";
        }else{
            $response = "END " . "Invalid Input";
        }

        header('Content-type: text/plain');
        echo $response;
    }

    private function linodeCurlPost($url){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Authorization: Bearer 0f2bc525c3fd7c1fbb2e78b71150ddb4e33db329ca38ca8b28f8dfb9f2fe2e43",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 0",
                "Content-Type: application/json",
                "Host: api.linode.com",
                "Postman-Token: e86c0df4-32fd-4d44-9617-fe97f87290d8,db771888-67dd-4876-8450-9afa4b25c4fd",
                "User-Agent: PostmanRuntime/7.20.1",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    }
    private function linodeCurlGet($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Authorization: Bearer 0f2bc525c3fd7c1fbb2e78b71150ddb4e33db329ca38ca8b28f8dfb9f2fe2e43",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "Host: api.linode.com",
                "Postman-Token: 6dea3e55-cbfc-4ecd-856f-df4cc77c6efe,eb5f4f71-41cc-40c4-bc35-bbfe10af6676",
                "User-Agent: PostmanRuntime/7.20.1",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}

