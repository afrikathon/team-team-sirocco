<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<div class="account-history">
    <div class="transactions">
        <h3 class="wik30"><b> Recent Transactions(NGN)</b></h3>
        <table>
            <tr>

                <?php
                if($model){
                    foreach ($model_4 as $model_us => $model_use) {
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

    <div class="savings">
        <h3 class="wik30"> Health Insurance Packages </h3>
        <table>
            <tr>

                <?php
                if($model){
                    foreach ($model_4 as $model_us => $model_use) {
                        if($model_use->insurance_type=="health" ) {
                            $dateopened = substr(date('r', strtotime($model_use->created_at)), 0, 16);
                            echo "<td><div class='wik9'><h4><span style='color: #aba093'>Insurance ( <span style='color:#d99b4a'>" . strtoupper($model_use->insurance_type) . "</span> )</span></h4><span class='amount wik9_5'>$model_use->amount</span><br>Insurance Company: $model_use->company_name <br>Date opened : $dateopened<br></div></td>";
                        }
                    }
                }else{
                    echo '<h4 style="color: #636364"><b>You currently have no Health Insurance Packages....</b></h4>';
                }
                ?>
            </tr>
        </table>
    </div>
    <br><br>
    <h3 class="wik30">Motor Insurance</h3>
    <div >
        <table>
            <tr>

                <?php
                if($model){
                    foreach ($model_4 as $model_us => $model_use) {
                        if($model_use->insurance_type=="car" ) {
                            $dateopened = substr(date('r', strtotime($model_use->created_at)), 0, 16);
                            echo "<td><div class='wik9'><h4><span style='color: #aba093'>Insurance ( <span style='color:#d99b4a'>" . strtoupper($model_use->insurance_type) . "</span> )</span></h4><span class='amount wik9_5'>$model_use->amount</span><br>Insurance Company: $model_use->company_name <br>Date opened : $dateopened<br></div></td>";
                        }
                    }
                }else{
                    echo '<h4 style="color: #636364"><b>You currently have no Health Insurance Packages....</b></h4>';
                }
                ?>
            </tr>
        </table>
    </div>
    <br><br>
    <h3 class="wik30">Others</h3>
    <div class="withdrawals" align="left">
        <table>
            <tr>

                <?php
                if($model){
                    foreach ($model_4 as $model_us => $model_use) {
                        if($model_use->insurance_type!="car" && $model_use->insurance_type!="health" ) {
                            $dateopened = substr(date('r', strtotime($model_use->created_at)), 0, 16);
                            echo "<td><div class='wik9'><h4><span style='color: #aba093'>Insurance ( <span style='color:#d99b4a'>" . strtoupper($model_use->insurance_type) . "</span> )</span></h4><span class='amount wik9_5'>$model_use->amount</span><br>Insurance Company: $model_use->company_name <br>Date opened : $dateopened<br></div></td>";
                        }
                    }
                }else{
                    echo '<h4 style="color: #636364"><b>You currently have no Health Insurance Packages.....</b></h4>';
                }
                ?>
            </tr>
        </table>
    </div>
</div>

<?php
Modal::begin([
    //'header'=>"<b><h4 id='reshead'></h4></b>",
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
