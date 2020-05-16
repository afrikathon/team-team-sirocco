<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
    <h3 style="color: #636364" align="left"><b>Choose Transfer Type</b></h3><br><br>
    <div class="row">
    <div class="col-sm-5 wik13 ">
                
                    <button value='<?php echo Url::to("transferpurse")?>' class='modalButton btn btn-warning' ><h4><b>Transfer money to another customer/company</b></h4></button>
                </div>
                <div class="col-sm-5 wik13">

               
                    <button value='<?php echo Url::to("transferbank")?>' class='modalButton btn btn-warning' ><h4><b>Transfer to bank account</b></h4></button>
                </div>  
     
	</div>

<?php
    Modal::begin([
        'id'=>'modal',
        'size'=>'modal-md',
        ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>