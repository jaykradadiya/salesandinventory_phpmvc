<div id="masterTable">
    <form action="" method="post">
    <table>
        <tr>
            <td>search Supplier</td>
            <td>
                <input type="text" name="s_search" id="s_search">
            </td>
            <td>
                <button name="search" id="search"> search</button>
            </td>
            <td>
            <button type="submit" name="add" id="add" value="add" formaction="<?php echo URIROOT."supplier/addSupplier"?>">Add Supplier</button> 
            </td>
        </tr>
        <tr>
            <table border="1">
            <tr>
                    <th>Supplier Id</th>
                    <th>Supplier Name</th>
                    <th>Supplier address</th>
                    <th>Supplier contect no</th>
                    <th>action</th>
                </tr>
                <?php
                 if($this->getdata("row")!=NULL)
                 {
                   
                     foreach ($this->getdata("row") as $key) {
                ?>
                
                <tr>
                <form method="post">
                    <td>&nbsp;&nbsp;<?php echo $key[0]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[1]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[2]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[3]?></td>
                    <td>
                        <!-- <a href="edit_employee.php"><button id="edit">edit</button></a> -->
                        <button type="submit" name="edit" id="edit" value="edit" formaction="<?php echo URIROOT."supplier/edit/".$key[0]?>">Edit</button>
                        <button type="submit" name="delete" id="delete" value="delete" formaction="<?php echo URIROOT."supplier/delete/".$key[0]?>">Delete</button>
                        
                        <!-- <a href="#"><button id="delete">delete</button></a></td> -->
                        </form>
                </tr>
                
                <?php    }
                }
                else
                {?>
                    <span id="error">no <?php echo "NO Supplier Found";?></span>
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