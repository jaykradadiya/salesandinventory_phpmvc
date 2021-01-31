<!-- <?php
echo "<pre>";
var_dump($this);
echo "</pre>";
?> -->

<div id="masterTable">
    <form action="" method="post">
        <table>
            <tr>
                <h1>edit supplier</h1>
            </tr>
            <tr>
                <td>supplier ID</td>
                <td><input type="number" name="supplier_id" id="supplier_id" value="<?php echo $this->getdata("supplier_id");?>" readonly></td>
                <td><span><?php echo $this->getdataError("supplier_id");?></span></td>
            </tr>
            <tr>
            <td>supplier name</td>
                <td><input type="text" name="supplier_name" id="supplier_name" value="<?php echo $this->getdata("supplier_name");?>"></td>
                <td><span><?php echo $this->getdataError("supplier_name");?></span></td>
            </tr>
            <tr>
                <td>supplier address</td>
                <td><input type="text" name="supplier_address" id="supplier_address"  value="<?php echo $this->getdata("supplier_address");?>"></td>
                <td><span><?php echo $this->getdataError("supplier_address");?></span></td>
            </tr>
            <tr>
                <td>supplier contectno</td>
                <td><input type="text" name="supplier_contect_no" id="supplier_contect_no"  value="<?php echo $this->getdata("supplier_contect_no");?>"></td>
                <td><span><?php echo $this->getdataError("supplier_contect_no");?></span></td>
            </tr>
               <td>
                    <button id="add" name="updateSupplier" value="update">update</button>
                </td>
                <td>
                <button name="back" id="back" formaction="<?= BACKBUTTION ?>"> Back</button>
                </td>
            </tr>
        </table>
        </form>
    </div>