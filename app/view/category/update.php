<div id="masterTable">
    <form action="" method="post">
        <table>
            <tr>
                <h1>edit category</h1>
            </tr>
            <tr>
                <td>category Id</td>
                <td><input type="text" name="category_id" id="category_id" value="<?php echo $this->getdata("category_id");?>" readonly></td>
            </tr>
            <tr>
                <td>category name</td>
                <td><input type="text" name="category_name" id="category_name" value="<?php echo $this->getdata("category_name");?>"></td>
                <td><span><?php echo $this->getdataError("category_name");?></span></td>
            </tr>
            </tr>
            <tr>
                <td>product description</td>
                <td><input type="text" name="Category_desciption" id="Category_desciption" value="<?php echo $this->getdata("Category_desciption");?>"></td>
                <td><span><?php echo $this->getdataError("Category_desciption");?></span></td>
            </tr>
            <tr>
            <td>
                    <button id="add" name="updateCategory" value="update">update</button>
                </td>
                <td>
                <button name="back" id="back" formaction="<?= BACKBUTTION ?>"> Back</button>
                </td>
            </tr>
        </table>
        </form>
    </div>