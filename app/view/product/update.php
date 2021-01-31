
<!-- product_id	
    product_name
    product_category
	product_price
    product_dis
    product_stoke
    product_supplier	
    product_pic -->
<div id="masterTable">
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <h1>edit product</h1>
            </tr>
            <tr>
                <td>product id</td>
                <td><input type="text" name="product_id" id="product_id" value="<?php echo $this->getdata("product_id");?>" readonly></td>
            </tr>
            <tr>
                <td>product name</td>
                <td><input type="text" name="product_name" id="product_name" value="<?php echo $this->getdata("product_name");?>"></td>
                <td><span><?php echo $this->getdataError("product_name");?></span></td>
            </tr>
            <tr>
                <td>product category</td>
                <td>
                    <select name="product_category" id="product_category" >
                    <?php
                     foreach ($this->getdata("category") as $key) {
                        ?>
                        
                        <option value="<?php echo $key[0];?>" <?php if($key[0]==$this->getdata("product_category")){echo "selected";}?>><?php echo $key[1];?></option>
                        
                        <?php
                     }
                    ?>

                   </select>
                   
                </td>
                <td><span><?php echo $this->getdataError("product_category");?></span></td>
            </tr>
            <tr>
                <td>product price</td>
                <td><input type="text" name="product_price" id="product_price" value="<?php echo $this->getdata("product_price");?>"></td>
                <td><span><?php echo $this->getdataError("product_price");?></span></td>
            </tr>
            <tr>
                <td>product supplier</td>
                <td>
                <select name="product_supplier" id="product_supplier" >
                    <?php
                     foreach ($this->getdata("supplier") as $key) {
                        ?>
                        
                        <option value="<?php echo $key[0];?>" <?php if($key[0]==$this->getdata("product_supplier")){echo "selected";}?>><?php echo $key[1];?></option>
                        
                        <?php
                     }
                    ?>
                   </select>
                    
                </td>
                <td><span><?php echo $this->getdataError("product_name");?></span></td>


            </tr>
            <tr>
                <td>product discription</td>
                <td><input type="text" name="product_dis" id="product_dis" value="<?php echo $this->getdata("product_dis");?>"></td>
                <td><span><?php echo $this->getdataError("product_dis");?></span></td>
            </tr>
            <tr>
                <td>product stoke</td>
                <td><input type="text" name="product_stoke" id="product_stoke" value="<?php echo $this->getdata("product_stoke");?>"></td>
                <td><span><?php echo $this->getdataError("product_stoke");?></span></td>
            </tr>
            
            <tr>
                <td>picture</td>
                <!-- <td><input type="file" name="product_pic" id="product_pic"></td> -->
                <td>
                    <img src="<?php echo "../../../public/pic/".$this->getdata("product_pic");?>" id="product_pic" alt="<?php echo $this->getdata("product_pic");?>" srcset="">
                    </td>
            </tr>
            <tr>
            <td>
                    <button id="add" name="updateProduct" value="update">update</button>
                </td>
                <td>
                    <button name="back" id="back" formaction="<?= BACKBUTTION ?>"> Back</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
   