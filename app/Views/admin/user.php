<main id="main" class="main">

    <div class="pagetitle">
        <h1>Users Table</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card" id="userlist" v-cloak>
                    <div class="card-body">
                        <h5 class="card-title">All Users </h5>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email Address</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="(item, index) in userlist" :key="userlist.index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{ item.firstname }} {{ item.lastname }}</td>
                                        <td>{{ item.username }}</td>
                                        <td>{{ item.email }}</td>
                                        <td>{{ item.created_at }}</td>
                                        <td>
                                            <button class="btn btn-danger"
                                                v-on:click.prevent="deleteUser(item.id,item.username)">
                                                <i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->