<?php 
echo "<pre>";
// var_dump($this->getdata("row"));
// var_dump($this);
echo "</pre>";
?> 

<div id="masterTable">
    <form action="" method="post">
    <table>
        <tr>
            <td>Bill Details</td>
        </tr>

        <tr>
            <table border="1">
                <tr>
                    <th>product ID</th>
                    <th>product price</th>
                    <th>quanitity</th>
                    <th>Price</th>
                </tr>
                <?php
               if($this->getdata("row")!=NULL)
               {
                   foreach ($this->getdata("row") as $key) {
                ?>
                
                <tr>
                    <td>&nbsp;&nbsp;<?php echo $key[0];?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[1];?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[2];?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[3];?></td>
                    
                </tr>
                
                <?php    }
                 }
                 else
                 {?>
                     <span id="error">no <?php echo "NO PRODUCT INSERTED";?></span>
                 <?php 
                 }
                ?>
                <tr>
                    <td>
                        <button name="back" id="back" formaction="<?=  BACKBUTTION ?>"> back</button>
                    </td>
                </tr>
    </table>
    </form>
</div>