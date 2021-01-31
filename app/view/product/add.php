
<!-- product_id	
    product_name
    product_category
	product_price
    product_dis
    product_stoke
    product_supplier	
    product_pic -->
<!-- <?php
// echo "<pre>";
// print_r($this);
// echo "</pre>";
?> -->
<div id="masterTable">
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <h1>add product</h1>
            </tr>
            <tr>
                <td>product name</td>
                <td><input type="text" name="product_name" id="product_name" value="<?php echo $this->getFormdata("product_name");?>"></td>
                <td><span><?php echo $this->getdataError("product_name");?></span></td>
            </tr>
            <tr>
                <td>product category</td>
                <td>
                    <select name="product_category" id="product_category">
                    <?php
                    foreach ($this->getdata("category") as $key) {
                        ?>
                           <option value="<?php echo $key[0];?>"><?php echo $key[1];?></option>
                        <?php
                    }
                    ?>
                      
                   </select>
                </td>
                <td><span><?php echo $this->getdataError("product_category");?></span></td>

            </tr>
            <tr>
                <td>product price</td>
                <td><input type="text" name="product_price" id="product_price" value="<?php echo $this->getFormdata("product_price");?>"></td>
                <td><span><?php echo $this->getdataError("product_price");?></span></td>

            </tr>
            <tr>
                <td>product discription</td>
                <td><input type="text" name="product_dis" id="product_dis" value="<?php echo $this->getFormdata("product_dis");?>"></td>
                <td><span><?php echo $this->getdataError("product_dis");?></span></td>
            </tr>
            <tr>
                <td>product supplier</td>
                <td>
                    <select name="product_supplier" id="product_supplier" >
                    <?php
                    foreach ($this->getdata("supplier") as $key) {
                        ?>
                           <option value="<?php echo $key[0];?>"><?php echo $key[1];?></option>
                        <?php
                    }
                    ?>
                      
                   </select>
                    
                </td>
                <td><span><?php echo $this->getdataError("product_supplier");?></span></td>

            </tr>
            <tr>
                <td>product stoke</td>
                <td><input type="text" name="product_stoke" id="product_stoke" value="<?php echo $this->getFormdata("product_stoke");?>"></td>
                <td><span><?php echo $this->getdataError("product_stoke");?></span></td>

            </tr>
            <tr>
                <td>picture</td>
                <td><input type="file" name="product_pic" id="product_pic" value="<?php echo $this->getFormdata("product_pic");?>"></td>
                <td><span><?php echo $this->getdataError("product_pic");?></span></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="addProduct" value="add">add</button>
                </td>
                <td>
                    <button name="back" id="back" formaction="<?= BACKBUTTION ?>"> back</button>
                </td>
            </tr>
        </table>
        </form>
    </div>