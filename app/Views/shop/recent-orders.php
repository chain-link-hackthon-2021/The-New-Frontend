<?php
    if(!empty($orders)){
?>
    <table class="table table-hover dataTable no-footer dtr-inline" id="TableId" role="grid" aria-describedby="TableId_info">
        <thead style="width: 100%;">
            <tr role="row">
                <th class="sorting_asc" rowspan="1" colspan="1" aria-label="Order Details">
                    Order Details
                </th>
                <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Payment Gateway">
                    Payment Gateway
                </th>
                <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Order Status">
                    Order Status
                </th>
                <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Date and Time">
                    Date and Time
                </th>
                <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Order Amount">
                    Order Amount (<strong><?= $shops[0]['CurrencyType']; ?></strong>)
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($orders)){
                ?>
                    <tr class="odd">
                        <td colspan="5" class="dataTables_empty" valign="top">No data available in table</td>
                    </tr>
                <?php
                } else {
                    foreach($orders as $order){
                        ?>
                        <tr>
                            <td class="text-center">
                                <?= $order['productName']; ?>
                            </td>
                            <td class="text-center">
                                <?= $order['paymentGateway']; ?>
                            </td>
                            <td class="text-center">
                                <?= $order['orderStatus']; ?>
                            </td>
                            <td class="text-center">
                                <?= $order['created_at']; ?>
                            </td>
                            <td class="text-center">
                                <?= $order['totalPrice']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>

            
        </tbody>
    </table>
<?php
    }
?>