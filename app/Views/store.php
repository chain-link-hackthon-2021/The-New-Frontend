

            <br><br>
            <div class="box p-2">
                <!-- <h4 style="font-size: 20px">Registered Customers</h4> -->
                <div id="data"></div>
                <!-- <hr> -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 text-center whitespace-no-wrap">Date</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Reference</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Amount</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Status</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Reason</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Remarks</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($trans as $tran): ?>
                            <tr>
                                <td class="border-b-2 text-center whitespace-no-wrap"><?= date("D, dS M Y | g:iA", strtotime($tran['created_at'])); ?></td>
                                <td class="border-b-2 text-center whitespace-no-wrap"><?= $tran['reference']; ?></td>
                                <td class="border-b-2 text-center whitespace-no-wrap"><?= $tran['amount']; ?></td>
                                <td class="border-b-2 text-center whitespace-no-wrap"><?= $tran['status']; ?></td>
                                <td class="border-b-2 text-center whitespace-no-wrap"><?= $tran['reason']; ?></td>
                                <td class="border-b-2 text-center whitespace-no-wrap"><?= $tran['remarks']; ?></td>
                                <td class="border-b-2 text-center whitespace-no-wrap"><?= $tran['type']; ?></td>
                                
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- // content -->
            <!-- Modal -->
            <!-- Modal -->
            <div class="modal" id="notifymodal" tabindex="-1">
                <div class="modal__content">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">Notifications</h2>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="preview p-5">
                            <div class="accordion"></div>
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                        <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Close</button>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
    <!-- // content -->