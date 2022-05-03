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
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Shop Owner</th>
                                    <th scope="col">Created At</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in userlist" :key="index">
                                    <th scope="row">{{index+1}}</th>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.owner }}</td>
                                    <td>{{ item.created_at }}</td>

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