<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">動態文字廣告管理</p>
    <!-- <form method="post" target="back" action="?do=tii"> -->
    <form method="post" action="./api/edit.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="80%">替代文字</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                 
                </tr>
                <?php
                    $rows=$Ad->all();
                  foreach($rows as $row){
                    $checked=($row['sh']==1)?"checked":"";
                ?>
                <tr>
                    
                    <td>
                        <input type="text" name="text[]" style="width: 95%;" value="<?=$row['text'];?>">
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>"  <?=$checked;?>>
                        <!-- sh沒有+[]時只有單選  有+[]時,為陣列可以複選 -->
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    </td>
                  
                        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                        <input type="button" 
                            onclick="op('#cover','#cvr','./model/ad.php')" 
                              value="新增動態文字廣告">
                    </td>
                    <td class="cent">
                        <input type="hidden" name="table" value="Ad">
                        <input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>