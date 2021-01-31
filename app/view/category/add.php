<div id="masterTable">
    <form action="" method="post">
        <table>
            <tr>
                <h1>add category</h1>
            </tr>
            <tr>
                <td>category name</td>
                <td><input type="text" name="category_name" id="category_name" value="<?php echo $this->getFormdata("category_name");?>"></td>
                <td><span><?php echo $this->getdataError("category_name");?></span></td>
            </tr>
            </tr>
            <tr>
                <td>product description</td>
                <td><input type="text" name="Category_desciption" id="Category_desciption"  value="<?php echo $this->getFormdata("Category_desciption");;?>"></td>
                <td><span><?php echo $this->getdataError("Category_desciption");?></span></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="addCategory" value="add">add</button>
                </td>
                <td>
                <button name="back" id="back" formaction="<?= BACKBUTTION ?>"> Back</button>
                </td>
            </tr>
        </table>
        </form>
    </div>