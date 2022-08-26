<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'insert'; // 頁面名稱
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;" novalidate >
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <!-- 這邊新增一條後可以用替換去改資料比較快 (ctrl+f) -->
                            <!-- 必填就加 required -->
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <!-- email 的 type 可以用 email 瀏覽器會幫你偵測 -->
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                        </div>

                        <div class="mb-3">
                            <label for="birthday" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                            <!-- birthday type 記得用 date -->
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <textarea class="form-control" id="address" name="address" cols="50" rows="3"></textarea>
                            <!-- textarea 標籤中間不能換行 -->
                            <!-- address 可用 textarea 比較大 -->
                        </div>

                        <div id="msgContainer">
                            <!-- 
                                <div class="alert alert-danger" role="alert">
                                A simple danger alert—check it out!
                                </div>
                            -->
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
// 要接在引入 script 後

const msgc = $('#msgContainer');

    function genAlert(msg, type='danger') {
        const a = $(`
        <div class="alert alert-${type}" role="alert">
            ${msg}
        </div>
        `);

        msgc.append(a);
        setTimeout(()=>{
            a.fadeOut(400, function(){
                a.remove();
            });
        }, 2000);
    }

function checkForm(){
     // 檢查欄位資料格式是不是符合
    let isPass = true; // 預設表單的資料是沒問題的
    const name = document.form1.name.value;
    const email = document.form1.email.value;

    if(name.length < 2){
        genAlert('請填寫正確姓名');
        isPass = false;
    }
    if(!email){
        genAlert('請填寫正確 email');
        isPass = false;
    }

    if(isPass){
         // 送出表單資料
        $.post(
            'data-insert-api.php', // 送給誰
            $(document.form1).serialize(), // 資料
            function(data){
                console.log(data);
                if(data.success){
                    genAlert('新增完成', 'success');
                }else{
                    genAlert(data.error);
                }
            },'json'); // 格式
    }
}
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>