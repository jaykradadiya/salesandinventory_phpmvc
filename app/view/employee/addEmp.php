
<div id="masterTable">
    <form  method="post" enctype="multipart/form-data">
        <table>
        <tr>
                <h1>add Employee</h1>
            </tr>
            <tr>
                <td>Employee Email</td>
                <td><input type="email" name="employee_email" id="employee_email" value="<?php echo $this->getFormdata("employee_email");?>"></td>
                <td><span><?php echo $this->getdataError("employee_email");?></span></td>
            </tr>
            <tr>
                <td>Employee Username</td>
                <td><input type="text" name="employee_username" id="employee_username" value="<?php echo $this->getFormdata("employee_username");?>" ></td>
                <td><span><?php echo $this->getdataError("employee_username");?></span></td>
            </tr>
            <tr>
                <td>employee type</td>
                <td>
                    <div class="custom-select">
                    <select name="employee_type" id="employee_type" >
                        <option value="" seleced>select type</option>
                       <option value="1" <?php if($this->getFormdata("employee_type")==1) echo "selected";?>>admin</option>
                       <option value="2" <?php if($this->getFormdata("employee_type")==2) echo "selected";?>>cashier</option>
                       <!-- <option value="3">biller</option> -->
                   </select>
                    </div>
                   
                </td>
                <td><span><?php echo $this->getdataError("employee_type");?></span></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="emp_password" id="emp_password" value="<?php echo $this->getFormdata("emp_password");?>" ></td>
                <td><span><?php echo $this->getdataError("emp_password");?></span></td>
            </tr>
            <tr>
                <td>picture</td>
                <td><input type="file" name="emp_pic" id="emp_pic" accept="image/*" value="<?php echo $this->getFormdata("emp_pic");?>" ></td>
                <td><span><?php echo $this->getdataError("emp_pic");?></span></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="addEmp" value="add"  formaction="<?php echo URIROOT."employee/addEmployee"?>">add</button>
                </td>
                <td>
                <button name="back" id="back" formaction="<?= BACKBUTTION ?>"> Back</button>
                    <!-- <button name="back" id="back"> back</button> -->
                </td>
            </tr>
        </table>
        </form>
    </div>
   