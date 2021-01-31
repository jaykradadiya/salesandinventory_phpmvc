<script src="<?php echo URIROOT."js/jquery.js"?>"></script>
<script src="<?php echo  URIROOT."js/addOreder.js"?>"></script>
<div id="masterTable">
        <form id="order_Table" onsubmit="return false">
            <table>
                <tr>
                    <td>
                        <h1>Take Order</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                    <table  border="1">
                        <tr>
                            <th>date</th>
                            <td><input type="date" name="date" id="date" value="<?php echo date('Y-m-d');?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td><input type="text" name="customerName" id="customerName" value="<?php echo $this->getFormdata("product_pic");?>"></td>
                            <td colspan="3"><span id="customerName"><?php echo $this->getdataError("customerName");?></span></td>
                        </tr>
                        <tr>
                            <th>Customer Mail address</th>
                            <td><input type="email" name="customerEmail" id="customerEmail" value="<?php echo $this->getFormdata("product_pic");?>"></td>
                            <td colspan="3"><span id="customerEmail"><?php echo $this->getdataError("customerEmail");?></span></td>

                        </tr>

                            <tbody id="product_buy">
                               
                                <tr>
                                <td><h1>Procuct Buy</h1></td>
                                    
                                </tr>
                                    <tr>
                                        <th>Procuct id</th>
                                        <!-- <th>product name</th> -->
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Buy Quntity</th>
                                        <th>total</th>
                                    </tr>

                            
                            </tbody>
                            <tr>
                            <td colspan="3"><span id="product_id"><?php echo $this->getdataError("product_id");?></span></td>

                           </tr>
                           <tr>
                           <td colspan="3"><span id="quantity"><?php echo $this->getdataError("quantity");?></span></td>
                           </tr>
                           <tr>
                           <td colspan="3"><span id="price"><?php echo $this->getdataError("price");?></span></td>

                           </tr>
                            <tr>
                                    <td><button name="additem" value="add" id="add">add</button></td>
                                    <td><button name="deleteitem" value="delete" id="delete">remove</button></td>
                                </tr>
                            </td>
                        </tr>
                        <tr>
                            <th>total</th>
                            <td><input type="number" name="total" id="total" readonly></td>
                            <td><span id="product_stoke"><?php echo $this->getdataError("total");?></span></td>

                        </tr>
                        <tr>
                            <th>customer paid</th>
                            <td><input type="number" name="O_paid" id="O_paid"></td>
                            <td><span id="product_stoke"><?php echo $this->getdataError("O_paid");?></span></td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                        <td>
                          <button name="addorder" id="addorder" value="add">add</button>
                        </td>
                </tr>
            </table>
        </form>
    </div>