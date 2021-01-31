<div id="masterTable">
    <form action=""  method="post">
    <table>
        <tr>
            <td>search product</td>
            <td>
                <input type="text" name="e_search" id="e_search">
            </td>
            <td>
                <button name="search" value="search" id="search"> search</button>
            </td>
            <td>
            <a href="../../../public/product/addProduct" id="add">Add Products</a>
            </td>
        </tr>
        <tr>
            <table border="1">
            <tr>
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Product category</th>
                    <th>Product Price</th>
                    <th>Product description</th>
                    <th>Product stoke</th>
                    <th>Product supplier</th>
                    <th>Picture</th>
                    <th>action</th>
                </tr>
                <?php
                if($this->getdata("row")!=NULL)
                {
                //   print_r($this->getdata("row"));
                    foreach ($this->getdata("row") as $key) {
                ?>
                
                <tr>
                <form method="post">
                    <td>&nbsp;&nbsp;<?php echo $key[0]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[1]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[2]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[3]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[4]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[5]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[6]?></td>
                    <td>
                    <img src="<?php echo URIROOT."pic/".$key[7]?>" id="viewimg" alt="<?php echo $key[7]?>" srcset="">
                    
                    </td>
                    <td>
                        <!-- <a href="edit_employee.php"><button id="edit">edit</button></a> -->
                        <button type="submit" name="stoke" id="stoke" value="stoke" formaction="<?php echo URIROOT."product/stokeUP/".$key[0]?>">stokeUP</button>
                        <button type="submit" name="edit" id="edit" value="edit" formaction="<?php echo URIROOT."product/edit/".$key[0]?>">Edit</button>
                        <button type="submit" name="delete" id="delete" value="delete" formaction="<?php echo URIROOT."product/delete/".$key[0]?>">Delete</button>
                        
                        <!-- <a href="#"><button id="delete">delete</button></a></td> -->
                        </form>
                </tr>
                
                <?php    }
                 }
                 else
                 {?>
                     <span id="error">no <?php echo "NO PRODUCT INSERTED";?></span>
                 <?php 
                 }
                 
                ?>
            </table>
        </tr>
    </table>
    </form>

    <div>
    
    
    <br>
    <br>
    <?php
        echo $this->getdata("pages");
    ?>
    </div>
</div>