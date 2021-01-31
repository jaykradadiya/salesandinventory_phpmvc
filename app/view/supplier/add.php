<div id="masterTable">
    <form action="" method="post">
        <table>
            <tr>
                <h1>add supplier</h1>
            </tr>
            <tr>
                <td>supplier name</td>
                <td><input type="text" name="supplier_name" id="supplier_name" value="<?php echo $this->getFormdata("supplier_name");?>"></td>
                <td><span><?php echo $this->getdataError("supplier_name");?></span></td>
            </tr>
            <tr>
                <td>supplier address</td>
                <td><input type="text" name="supplier_address" id="supplier_address"  value="<?php echo $this->getFormdata("supplier_address");?>"></td>
                <td><span><?php echo $this->getdataError("supplier_address");?></span></td>
            </tr>
            <tr>
                <td>supplier contectno</td>
                <td><input type="text" name="supplier_contect_no" id="supplier_contect_no"  value="<?php echo $this->getFormdata("supplier_contect_no");?>"></td>
                <td><span><?php echo $this->getdataError("supplier_contect_no");?></span></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="addSupplier" value="add">add</button>
                </td>
                <td>
                <button name="back" id="back" formaction="<?= BACKBUTTION ?>"> Back</button>
                </td>
            </tr>
        </table>
        </form>
    </div>