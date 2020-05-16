<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<div >
    <div class="transactions" align="left">
        <h3 style="color: #636364"><b>Your Recent Insurance Packages (NGN)</b></h3>
<table>
            <tr>
                
                <?php
                    if($model){
                        foreach ($model as $model_us => $model_use) {
                            $dateopened = substr(date('r', strtotime($model_use->created_at)),0,16);
                            echo "<td><div class='wik9'><h4><span style='color: #aba093'>Insurance ( <span style='color:#d99b4a'>".strtoupper($model_use->insurance_type)."</span> )</span></h4><span class='amount wik9_5'>$model_use->amount</span><br>Insurance Company: $model_use->company_name <br>Date opened : $dateopened<br></div></td>";
                        }
                    }else{
                        echo '<h4 style="color: #636364"><b>You currently have no recent transaction....</b></h4>';
                    }
                ?>
            </tr>
        </table>
    </div>
    <br><br>
    <h3 style="color: #636364"><b>Insurance Products</b></h3>
    <div class="savings">
        <div class="row">
                <div class="col-sm-4 wik11" >
                    <img src="../images/housing.svg" class="package-img"/><b>Health Insurance</b>
                
                    <button value='<?php $plan='health';echo Url::to("selectplan?plan=$plan")?>' class='modalButton btn package-btn' > Check Now</button>
                </div>
                <div class="col-sm-4 wik11" >
                    <img src="../images/education.svg" class="package-img"><b>Motor Insurance</b>
                    <button value='<?php $plan='car';echo Url::to("selectplan?plan=$plan")?>' class='modalButton btn package-btn' >  Check Now</button>
                    </div>
        </div>
        <div class="row">
        <div class="col-sm-4 wik11" >
                    <img src="../images/land.svg" class="package-img"/><b>Agric Insurance</b>
              
                    <button value='<?php $plan='agric';echo Url::to("selectplan?plan=$plan")?>' class='modalButton btn package-btn' >  Check Now</button>
        </div>
        <div class="col-sm-4 wik11" >
                    <img src="../images/tours.svg" class="package-img"><b>Property Insurance</b>
               
                    <button value='<?php $plan='property';echo Url::to("selectplan?plan=$plan")?>' class='modalButton btn package-btn' >  Check Now</button>
        </div>
        </div> 
        <div class="row">
        <div class="col-sm-4 wik11" >
                    <img src="../images/plane.svg" class="package-img"/><b>Flight</b>
               
                    <button value='<?php $plan='flight';echo Url::to("selectplan?plan=$plan")?>' class='modalButton btn package-btn' > Check Now</button>
        </div>
        <div class="col-sm-4 wik11">
                    <img src="../images/rent.svg" class="package-img"><b>Others</b>
               
                    <button value='<?php $plan='others';echo Url::to("selectplan?plan=$plan")?>' class='modalButton btn package-btn' > Check Now</button>
        </div>
        </div>                         
    </div>
    <br><br>
    <h3 style="color: #636364"><b>Investment Plans</b></h3>
    <div class="row">
    <div class="col-sm-5 wik13">

                    <img src="../images/longterm.svg" width="85px" height="95px"> &nbsp;&nbsp
                
                    <button value='<?php $plan='investment';echo Url::to("selectplan?plan=$plan")?>' class='modalButton btn btn-warning' ><h4><b>Investment</b></h4></button>
                </div>
                <div class="col-sm-5 wik13">

                    <img src="../images/shortterm.svg" width="90px" height="95px"> &nbsp;&nbsp 
               
                    <button value='<?php $plan='pension';echo Url::to("selectplan?plan=$plan")?>' class='modalButton btn btn-warning' ><h4><b>Pensions</b></h4></button>
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
<script type="text/javascript">
    x=document.getElementsByClassName("amount");
    for(var i = 0; i < x.length; i++){
    x[i].innerText=parseFloat(x[i].innerText).toLocaleString();  
    }
</script>