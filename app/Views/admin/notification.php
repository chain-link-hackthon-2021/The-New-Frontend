<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order Credit Table</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/backend">Home</a></li>

                <li class="breadcrumb-item active">Credit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section" id="notification" v-cloak>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Notification </h5>
                        <div class="form-group mt-3">

                            <label for="">Message To</label>
                            <select class="form-control" ref="msgto">
                                <option>--Select Message To--</option>
                                <option value="all">All Vender</option>
                                <?php
                                //  print_r($shops);
                                foreach ($shops as $value) {
                                    echo ' <option value="' . $value["name"] . '">' . $value["name"] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Subject</label>
                            <input type="text" class="form-control" v-model="subject">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Message</label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="msg"></textarea>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-dark btn-block" @click="btnNotification"
                                :disabled="btnState">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Users </h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Message Type</th>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Subject </th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in notlist" :key="index">
                                    <th scope="row">{{index+1}}</th>
                                    <td>{{ item.msg_type }}</td>
                                    <td>{{ item.shopName }}</td>
                                    <td>{{ item.subject }}</td>
                                    <td>{{ item.message }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>
                                        <button class="btn btn-danger" @click="delnotification(item.id)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->