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
                    this.userlist = res.data.shops;
                } catch (error) {}
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