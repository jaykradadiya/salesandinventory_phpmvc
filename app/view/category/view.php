<div id="masterTable">
    <form action="" method="post">
    <table>
        <tr>
            <td>search category</td>
            <td>
                <input type="text" name="c_search" id="c_search">
            </td>
            <td>
                <button name="search" id="search"> search</button>
            </td>
            <td>
            <button type="submit" name="add" id="add" value="add" formaction="<?= URIROOT."category/addCategory"?>">Add Category</button>
                <!-- <button name="add" id="add"> add</button> -->
            </td>
        </tr>
        <tr>
            <table border="1">
            <tr>
                    <th>Category Id</th>
                    <th>Category Name</th>
                    <th>Category description</th>
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
                    <td>
                        <!-- <a href="edit_employee.php"><button id="edit">edit</button></a> -->

                        <button type="submit" name="edit" id="edit" value="edit" formaction="<?= URIROOT."category/edit/".$key[0]?>">Edit</button>
                        <button type="submit" name="delete" id="delete" value="delete" formaction="<?= URIROOT."category/delete/".$key[0]?>">Delete</button>
                        <!-- <a href="../../../public/category/edit/<?php echo $key[0];?>" id="edit">Edit</a>
                        <a href="../../../public/category/delete/<?php echo $key[0];?>" id="delete">Delete</a>
                         -->
                        <!-- <a href="#"><button id="delete">delete</button></a> -->
                        </td>
                        </form>
                </tr>
                
                <?php    }
                }
                else
                {?>
                    <span id="error">no <?php echo "NO Category INSERTED";?></span>
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