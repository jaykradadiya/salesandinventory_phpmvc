<!-- <pre>
<?php
var_dump($this);
?>
</pre> -->

<div id="masterTable">
    <form  method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <h1>Edit Employee</h1>
            </tr>
            <tr>
                <td>Employee ID</td>
                <td><input type="text" name="empID" id="empID" value="<?php echo $this->getdata("empID");?>" readonly></td>
            </tr>
            <tr>
                <td>Employee Email</td>
                <td><input type="text" name="empEmail" id="empEmail" value="<?php echo $this->getdata("empEmail");?>" readonly></td>
            </tr>
            <tr>
                <td>Employee Username</td>
                <td><input type="text" name="empUsername" id="empUsername" value="<?php echo $this->getdata("empUsername");?>" readonly></td>
            </tr>
            <tr>
                <td>employee type</td>
                <td>
                    <div class="custom-select">
                    <select name="empType" id="empType" >
                       <option value="1" <?php if($this->getdata("empType")==1) echo "selected";?>>admin</option>
                       <option value="2" <?php if($this->getdata("empType")==2) echo "selected";?>>cashier</option>
                       <!-- <option value="3">biller</option> -->
                   </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="empPassword" id="empPassword" value="<?php echo $this->getdata("empPassword");?>" ></td>
                <td><span><?php echo $this->getdataError("empPassword");?></span></td>
            </tr>
            <tr>
                <td>picture</td>
                <!-- <td><input type="file" name="emp_pic" id="emp_pic" accept="image/*" value="<?php echo "pic/".$this->getdata("pic");?>"></td> -->
                <td>
                    <img src="<?php echo URIROOT."/pic/".$this->getdata("pic");?>" id="viewimg" alt="<?php echo $this->getdata("pic");?>" srcset="">
                    </td>
                    <!-- <td><span><?php echo $errorfile;?></span></td> -->
            </tr>
            <tr>
                <td>
                    <button id="add" name="updateEmp" value="update">update</button>
                </td>
                <td>
                <button name="back" id="back" formaction="<?= BACKBUTTION ?>"> Back</button>
                   
                </td>
            </tr>
        </table>
        </form>
    </div>