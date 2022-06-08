var baseUrl;
if (document.getElementById("base_url")) {
    baseUrl = document.getElementById("base_url").value;
}
var config = {
    headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Headers": "*",
        "Content-Type": "multipart/form-data",
        "Access-Control-Allow-Headers": "Origin, Content-Type, X-Auth-Token",
        "content-type": "application/json",
        "Access-Control-Allow-Methods": " GET, POST, PUT, DELETE",
        "Content-Type": "application/x-www-form-urlencoded",
    },
};

var loading = `<div class="spinner-grow spinner-grow-sm" role="status">
<span class="visually-hidden">Loading...</span>
</div>`;

if (document.getElementById("shoplist")) {
    const app = Vue.createApp({
        data() {
            return {
                shoplist: [],
            };
        },
        mounted() {
            this.loadshop();
        },
        methods: {
            async loadshop() {
                try {
                    let res = await axios.get(
                        baseUrl + "api/v1/admin/all/shop",
                        config
                    );
                    this.shoplist = res.data.shops;
                    console.log(res.data);
                    setTimeout(() => {
                        var myTable = document.querySelector("#myTable");
                        var dataTable = new DataTable(myTable);
                    }, 1200);
                } catch (error) {}
            },
        },
    }).mount("#shoplist");
}
if (document.getElementById("userlist")) {
    const app = Vue.createApp({
        data() {
            return {
                userlist: [],
            };
        },
        created() {},
        mounted() {
            this.loadshop();
        },
        methods: {
            async loadshop() {
                try {
                    let res = await axios.get(
                        baseUrl + "api/v1/fetch/all/users",
                        config
                    );
                    this.userlist = res.data;
                    if (res.status == 200) {
                        setTimeout(() => {
                            var myTable = document.querySelector("#myTable");
                            var dataTable = new DataTable(myTable);
                        }, 2200);
                    }
                    console.log(res);
                } catch (error) {}
            },
            deleteUser(id, shopname) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        reverseButtons: true,
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: "warning",
                                title: "Enter Your Password",
                                input: "text",
                                inputAttributes: {
                                    autocapitalize: "off",
                                },
                                showCancelButton: true,
                                confirmButtonText: "Delete it",
                                showLoaderOnConfirm: true,
                                preConfirm: (login) => {
                                    let fm = {
                                        password: login,
                                        authuser: "femi",
                                        username: shopname,
                                        id: id,
                                    };
                                    axios
                                        .post("/api/deleteUser", fm)
                                        .then((response) => {
                                            if (response.data == 1) {
                                                swalWithBootstrapButtons.fire(
                                                    "Deleted!",
                                                    "Your file has been deleted.",
                                                    "success"
                                                );
                                                setTimeout(() => {
                                                    window.location.href = "";
                                                }, 1200);
                                            } else if (response.data == 2) {
                                                swalWithBootstrapButtons.fire(
                                                    "Not Deleted!",
                                                    "Invalid Password Provided.",
                                                    "error"
                                                );
                                                setTimeout(() => {
                                                    window.location.href = "";
                                                }, 1200);
                                            } else {}
                                        })
                                        .catch((error) => {
                                            Swal.showValidationMessage(
                                                `Request failed: ${error}`
                                            );
                                        });
                                },
                                allowOutsideClick: () => !Swal.isLoading(),
                            });
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                "Cancelled",
                                "Your imaginary file is safe :)",
                                "error"
                            );
                        }
                    });
            },
        },
    }).mount("#userlist");
}
if (document.getElementById("creditlist")) {
    const app = Vue.createApp({
        data() {
            return {
                creditlist: [],
            };
        },
        mounted() {
            this.loadorderCredit();
        },
        methods: {
            async loadorderCredit() {
                try {
                    let res = await axios.get(
                        baseUrl + "api/v1/admin/all/shop",
                        config
                    );
                    this.creditlist = res.data.shops;
                } catch (error) {}
            },
        },
    }).mount("#creditlist");
}
if (document.getElementById("addcredit")) {
    const app = Vue.createApp({
        data() {
            return {
                creditlist: [],
                amount: "",
                creditQ: "",
                btnValue: "Add Credit",
                btnState: false,
            };
        },
        mounted() {
            this.loadCredit();
        },
        methods: {
            async addcredit() {
                this.btnState = true;
                this.btnValue = loading;

                if (this.amount == "" || this.creditQ == "") {
                    this.btnValue = "Add";
                    this.btnState = false;
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });
                    Toast.fire({
                        icon: "error",
                        title: "Empty Field",
                    });
                } else {
                    data = JSON.stringify({
                        creditQuantity: this.creditQ,
                        creditPrice: this.amount,
                    });
                    try {
                        let res = await axios.post(
                            baseUrl + "api/v1/admin/add/credits",
                            data,
                            config
                        );
                        if (res.data.status == "success") {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        "mouseenter",
                                        Swal.stopTimer
                                    );
                                    toast.addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer
                                    );
                                },
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Credit Added Successfully",
                            });
                            setTimeout(() => {
                                window.location.href = "";
                            }, 3000);
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        "mouseenter",
                                        Swal.stopTimer
                                    );
                                    toast.addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer
                                    );
                                },
                            });
                            Toast.fire({
                                icon: "error",
                                title: "Error Data.",
                            });
                            this.btnValue = "Add";
                            this.btnState = false;
                        }
                        setTimeout(() => {
                            window.location.href = "";
                        }, 3000);
                    } catch (error) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener(
                                    "mouseenter",
                                    Swal.stopTimer
                                );
                                toast.addEventListener(
                                    "mouseleave",
                                    Swal.resumeTimer
                                );
                            },
                        });
                        Toast.fire({
                            icon: "error",
                            title: "Error Data Already Exist.",
                        });
                        this.btnValue = "Add";
                        this.btnState = false;
                    }
                }
            },
            deleteaddCredit(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then(async(result) => {
                    if (result.isConfirmed) {
                        let data = JSON.stringify({ id: id });
                        try {
                            let res = await axios.post(
                                baseUrl + "api/v1/delete/admin/credits",
                                data,
                                config
                            );
                            if (res.data.status == "success") {
                                Swal.fire(
                                    "Deleted!",
                                    "Credit Has Been Deleted Successfully.",
                                    "success"
                                );
                                setTimeout(() => {
                                    window.location.href = "";
                                }, 2500);
                            }
                            this.creditlist = res.data.credits;
                        } catch (error) {}
                    }
                });
            },
            async loadCredit() {
                try {
                    let res = await axios.get(
                        baseUrl + "api/v1/fetch/admin/credits",
                        config
                    );
                    if (res.data.status == "success") {}
                    this.creditlist = res.data.credits;
                } catch (error) {}
            },
        },
    }).mount("#addcredit");
}
if (document.getElementById("creditorder")) {
    const app = Vue.createApp({
        data() {
            return {
                creditlist: [],
            };
        },
        mounted() {
            this.loadCredit();
        },
        methods: {
            async loadCredit() {
                try {
                    let res = await axios.get(
                        baseUrl + "api/v1/fetch/all/credit/orders",
                        config
                    );
                    if (res.data.status == "success") {}
                    this.creditlist = res.data.creditOrders;
                } catch (error) {}
            },
        },
    }).mount("#creditorder");
}
if (document.getElementById("notification")) {
    const app = Vue.createApp({
        data() {
            return {
                notlist: [],
                msg: "",
                subject: "",
                btnState: false,
            };
        },
        mounted() {
            this.loadNotification();
        },
        methods: {
            async btnNotification() {
                if (
                    this.msg == "" ||
                    this.$refs.msgto.value == "" ||
                    this.subject == ""
                ) {
                    alert("Empty Data");
                } else {
                    this.btnState = true;
                    let fm = {
                        msg_type: this.$refs.msgto.value == "all" ?
                            "all" :
                            "personal",
                        shopname: this.$refs.msgto.value,
                        subject: this.subject,
                        message: this.msg,
                    };
                    const res = await axios.post(
                        baseUrl + "api/v1/add/notifications",
                        fm,
                        config
                    );
                    try {
                        if (res.data.status == "success") {
                            alert("Message Sent Successfully");
                            setTimeout(() => {
                                window.location.href = "";
                            }, 2000);
                        } else {
                            this.btnState = false;
                        }
                    } catch (error) {
                        this.btnState = false;
                    }
                }
            },
            async loadNotification() {
                try {
                    let res = await axios.get(
                        baseUrl + "api/v1/all/admin/notifications",
                        config
                    );
                    if (res.data.status == "success") {}
                    this.notlist = res.data.notifications;
                } catch (error) {}
            },
            delnotification(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger",
                    },
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons
                    .fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        reverseButtons: true,
                    })
                    .then(async(result) => {
                        if (result.isConfirmed) {
                            let fm = {
                                id: id,
                            };
                            const res = await axios.post(
                                baseUrl + "api/v1/notifications/delete/id",
                                fm,
                                config
                            );
                            try {
                                if (res.data.status == "success") {
                                    swalWithBootstrapButtons.fire(
                                        "Deleted!",
                                        "Your file has been deleted.",
                                        "success"
                                    );
                                    setTimeout(() => {
                                        window.location.href = "";
                                    }, 2000);
                                } else {
                                    this.btnState = false;
                                }
                            } catch (error) {
                                this.btnState = false;
                            }
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                "Cancelled",
                                "Your imaginary file is safe :)",
                                "error"
                            );
                        }
                    });
            },
        },
    }).mount("#notification");
}
if (document.getElementById("adminlogin")) {
    const app = Vue.createApp({
        data() {
            return {
                username: "",
                password: "",
                token: "",
                btnState: false,
            };
        },

        methods: {
            async BtnLogin() {
                if (this.username == "" || this.password == "") {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });
                    Toast.fire({
                        icon: "error",
                        title: "Empty Data",
                    });
                } else {
                    this.btnState = true;
                    let fm = {
                        email: this.username,
                        pass: this.password,
                    };
                    const res = await axios.post(
                        baseUrl + "api/v1/admin/login",
                        fm,
                        config
                    );

                    try {
                        if (res.data.status === "success") {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        "mouseenter",
                                        Swal.stopTimer
                                    );
                                    toast.addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer
                                    );
                                },
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Token Sent Please Check Your Mail",
                            });
                            setTimeout(() => {
                                window.location.href =
                                    "/backend/auth/" + res.data.adminID;
                            }, 2000);
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        "mouseenter",
                                        Swal.stopTimer
                                    );
                                    toast.addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer
                                    );
                                },
                            });
                            Toast.fire({
                                icon: "error",
                                title: "Invaild Username OR Password",
                            });

                            this.btnState = false;
                        }
                    } catch (error) {
                        this.btnState = false;
                    }
                }
            },
            async BtnLoginVerify(id) {
                if (this.token === "" || id === "") {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener(
                                "mouseenter",
                                Swal.stopTimer
                            );
                            toast.addEventListener(
                                "mouseleave",
                                Swal.resumeTimer
                            );
                        },
                    });
                    Toast.fire({
                        icon: "error",
                        title: "Empty Data",
                    });
                } else {
                    this.btnState = true;
                    let fm = {
                        token: this.token,
                        adminID: id,
                    };
                    const res = await axios.post("/api/adminLogin", fm, config);
                    try {
                        if (res.data == 1) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        "mouseenter",
                                        Swal.stopTimer
                                    );
                                    toast.addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer
                                    );
                                },
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Login Was Successfully",
                            });
                            setTimeout(() => {
                                window.location.href = "/backend";
                            }, 2000);
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        "mouseenter",
                                        Swal.stopTimer
                                    );
                                    toast.addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer
                                    );
                                },
                            });
                            Toast.fire({
                                icon: "error",
                                title: "Invaild Token",
                            });

                            this.btnState = false;
                        }
                    } catch (error) {
                        this.btnState = false;
                    }
                }
            },
        },
    }).mount("#adminlogin");
}