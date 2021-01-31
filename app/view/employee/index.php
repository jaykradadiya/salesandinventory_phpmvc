<div id="masterTable">
    <form action=""  method="post">
    <table>
        <tr>
            <td>search product</td>
            <td>
                <input type="text" name="e_search" id="e_search">
            </td>
            <td>
            <!-- <a href="../public/employee">Search</a> -->
            <button name="search" value="search" id="search"> search</button>               
            </td>
            <td>
            <button type="submit" name="add" id="add" value="add" formaction="<?php echo URIROOT."employee/addEmployee"?>">Add Employess</button>
                <!-- <button name="add" id="add"> add</button> -->
            </td>
        </tr>
        <tr>
            <table border="1">
            <tr>
                    <th>employee Id</th>
                    <th>employee email</th>
                    <th>employee UserName</th>
                    <th>employee type</th>
                    <th>employee pic</th>
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
                    <td>&nbsp;&nbsp;<?php 
                    if($key[4]==1) 
                    {
                        echo "admin";
                    }
                    elseif ($key[4]==2) {
                        echo "cashier";
                        
                    }
                    else
                    { $key[4];
                    }?></td>
                    <td>
                    <img src="<?php echo URIROOT."pic/".$key[5]?>" id="viewimg" alt="<?php echo $key[5]?>" srcset="">
                    
                    </td>
                    <td>
                        <!-- <a href="edit_employee.php"><button id="edit">edit</button></a> -->

                        <button type="submit" name="edit" id="edit" value="edit" formaction="<?php echo URIROOT."employee/edit/".$key[0]?>">Edit</button>
                       
                        <?php if($key[4]!="1")
                        { ?>
                         <button type="submit" name="delete" id="delete" value="delete" formaction="<?php echo URIROOT."employee/delete/".$key[0]?>">Delete</button>
                        <?php }?>
                        
                        </form>
                </tr>
                
                <?php    }
                 }
                 else
                 {?>
                     <span id="error">no <?php echo "NO Employee Data Found";?></span>
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