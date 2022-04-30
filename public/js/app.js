var baseUrl;
if (document.getElementById("base_url")) {
    baseUrl = document.getElementById("base_url").value;
}
if (document.getElementById("site_url")) {
    siteUrl = document.getElementById("site_url").value;
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

const loading = `<div class="spinner-grow spinner-grow-sm" role="status">
<span class="visually-hidden">Loading...</span>
</div>`;

if (document.getElementById("loadpayment")) {
    const app = Vue.createApp({
        data() {
            return {
                price: 0,
                btnState: false,
                btnoneValue: "Pay With PayPal",
                btntwoValue: '<i class="fas fa-bitcoin " style="vertical-align: middle;"></i> Pay With Crypto',
            };
        },
        mounted() {},
        methods: {
            async paycheckout(paymethod) {
                //alert(process.env);
                this.btnoneValue = loading;
                this.btntwoValue = loading;
                this.btnState = true;
                let unitPrice = this.$refs.unitPrice.value;
                let shopName = this.$refs.shopName.value;
                let quantity = this.$refs.quantity.value;
                let paymentGateway = paymethod;
                let orderFrom = this.$refs.orderFrom.value;
                let totalPrice = this.$refs.price.value;
                let productName = this.$refs.productName.value;
                let productId = this.$refs.productId.value;

                let res = await axios.get(
                    "https://blockchain.info/tobtc?currency=USD&value=" +
                    totalPrice
                );
                try {
                    // console.log(res.data);
                    let fm = {
                        shopName: shopName,
                        productId: productId,
                        productName: productName,
                        unitPrice: unitPrice,
                        ProductPrice: totalPrice,
                        Quantity: quantity,
                        orderFrom: orderFrom,
                        paymentGateway: paymentGateway,
                        btcAmount: res.data,
                    };
                    //console.log(fm);
                    let ress = await axios.post(
                        baseUrl + "api/v1/add/new/orders",
                        fm,
                        config
                    );
                    try {
                        if (ress.data.status !== "error") {
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
                                icon: "info",
                                title: "Please Wait,Your Order Has Been Created...",
                            });
                            if (paymentGateway == "paypal") {
                                setTimeout(() => {
                                    window.location.href =
                                        "/@" +
                                        shopName +
                                        "/OrderDetails/" +
                                        ress.data.orders.orderId;
                                }, 3000);
                            } else {
                                setTimeout(() => {
                                    window.location.href =
                                        "/@" +
                                        shopName +
                                        "/CryptoPayment/" +
                                        ress.data.orders.orderId;
                                }, 3000);
                            }
                        } else {
                            this.btnoneValue = "Pay With PayPal";
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
                                title: "Error in Connecting...",
                            });
                            setTimeout(() => {
                                window.location.href = "";
                            }, 3000);
                        }
                    } catch (err) {
                        console.log(err);
                    }
                } catch (err) {
                    console.log(err);
                }
            },
        },
    }).mount("#loadpayment");
}
if (document.getElementById("payment")) {
    const app = Vue.createApp({
        data() {
            return {
                price: 0,
                btnState: false,
                btnoneValue: "Pay With PayPal",
            };
        },
        mounted() {
            const script = document.createElement("script");
            script.src =
                "https://www.paypal.com/sdk/js?client-id=AZ4nF2Gcr-Afy1P2zqp8MeUIQ7kSS-e9kvADv5ynLTtw4HC_jMucHIvHesgXLRx8ooWebaJffVKp0yNW";
            script.addEventListener("load", this.setLoaded);
            document.body.appendChild(script);
        },
        methods: {
            setLoaded() {
                let price = this.$refs.amount.value;
                let orderid = this.$refs.orderid.value;

                window.paypal
                    .Buttons({
                        createOrder: (data, actions) => {
                            return actions.order.create({
                                purchase_units: [{
                                    //description: this.product.description,
                                    amount: {
                                        currency_code: "USD",
                                        value: "" + price,
                                    },
                                }, ],
                            });
                        },
                        onApprove: async(data, actions) => {
                            const order = await actions.order.capture();

                            if (order.status == "COMPLETED") {
                                let pId = this.$refs.uniqueID.value;
                                let quantity = this.$refs.quantity.value;
                                // let NewStock = 0;
                                try {
                                    let res = await axios.post(
                                        baseUrl + "api/v1/fetch/single/product", { uniqueID: pId },
                                        config
                                    );
                                    // let stock = 66;
                                    let stock =
                                        parseInt(res.data.product[0].stock) -
                                        parseInt(quantity);

                                    // console.log(res.data.product[0].stock, quantity, pId);

                                    axios
                                        .post(
                                            baseUrl +
                                            "api/v1/update/order/status", {
                                                orderId: orderid,
                                                orderStatus: "completed",
                                            },
                                            config
                                        )
                                        .then((response) => {
                                            axios
                                                .post(
                                                    baseUrl +
                                                    "api/v1/update/product/stock", {
                                                        productId: pId,
                                                        stock: stock,
                                                    },
                                                    config
                                                )
                                                .then((response) => {
                                                    if (
                                                        response.data.status ==
                                                        "success"
                                                    ) {
                                                        window.location.href =
                                                            "/Completed/" +
                                                            orderid;
                                                    } else {
                                                        window.location.href =
                                                            "";
                                                    }
                                                });
                                        });

                                    //
                                } catch (error) {}
                            }
                        },
                        onError: (err) => {
                            console.log(err);
                        },
                    })
                    .render(this.$refs.paypal);
            },
        },
    }).mount("#payment");
}

if (document.getElementById("user")) {
    const app = Vue.createApp({
        data() {
            return {
                listuser: [],
                btnState: false,
                userinfo: {
                    surname: "",
                    lastname: "",
                    address: "",
                    email: "",
                    phone: "",
                    bankname: "",
                    acct_name: "",
                    acct_num: "",
                    country: "",
                    currency: "",
                    acct_type: "",
                    iban: "",
                    swift_code: "",
                    country: "",
                },
                userinfoimage: "",
            };
        },
        mounted() {
            this.user();
        },
        methods: {
            async user() {
                const res = await axios.post(baseUrl + "/AxiosAdmin/getUser");
                try {
                    this.listuser = res.data;
                } catch (error) {}
            },
            async btnaction(id, status) {
                const fm = new FormData();
                fm.append("user_id", id);
                fm.append("status", status);
                const res = await axios.post(
                    baseUrl + "/AxiosAdmin/UserAction",
                    fm
                );
                try {
                    //console.log(res.data);
                    if (res.data) {
                        setTimeout(() => {
                            window.location.href = "";
                        }, 3000);
                        if (status == 1) {
                            Toast.fire({
                                icon: "success",
                                title: "Account UnBlock or Unlock",
                            });
                        } else if (status == 2) {
                            Toast.fire({
                                icon: "success",
                                title: "Account Block",
                            });
                        } else {
                            Toast.fire({
                                icon: "success",
                                title: "Account Lock",
                            });
                        }
                    }
                } catch (error) {}
            },
            onFileChange(event) {
                var files = event.target.files || event.dataTransfer.files;
                //console.log(files)
                if (files.length > 0) {
                    return (this.userinfoimage = files[0]);
                }
            },
            async CreateAccount() {
                // console.table(this.userinfoimage);
                if (
                    this.userinfoimage == "" ||
                    this.userinfo.surname == "" ||
                    this.userinfo.lastname == "" ||
                    this.userinfo.address == "" ||
                    this.userinfo.email == "" ||
                    this.userinfo.phone == "" ||
                    this.userinfo.bankname == "" ||
                    this.userinfo.acct_name == "" ||
                    this.userinfo.acct_num == "" ||
                    this.userinfo.currency == ""
                ) {
                    Toast.fire({
                        icon: "error",
                        title: "Fill Up Empty Data",
                    });
                } else {
                    this.btnState = true;
                    const fm = new FormData();
                    fm.append("userinfo", JSON.stringify(this.userinfo));
                    fm.append("file", this.userinfoimage);
                    const res = await axios.post(
                        baseUrl + "/AxiosAdmin/CreateUserAcct",
                        fm
                    );
                    try {
                        if (res.data == 1) {
                            Toast.fire({
                                icon: "success",
                                title: "Account Created Successfully",
                            });
                            setTimeout(() => {
                                window.location.href =
                                    baseUrl + "/backend/user/create";
                            }, 3500);
                        } else if (res.data == 2) {
                            Toast.fire({
                                icon: "info",
                                title: "Account Already Exist!!",
                            });
                        } else {
                            Toast.fire({
                                icon: "error",
                                title: "Error in Connecting...",
                            });
                            setTimeout(() => {
                                //window.location.href = baseUrl + "/backend/user/create"
                            }, 3500);
                        }
                    } catch (error) {}
                }
            },
            nextPage(id) {
                window.location.href = baseUrl + "/backend/fundaccount/" + id;
            },
            nextPagewithdraw(id) {
                window.location.href = baseUrl + "/backend/withdraw/" + id;
            },
        },
    }).mount("#user");
}
if (document.getElementById("btcpayment")) {
    const app = Vue.createApp({
        data() {
            return {
                paidamount: 0,
            };
        },
        mounted() {
            this.getDepositBalance();
        },
        methods: {
            getDepositBalance() {
                var newAddress = this.$refs.newAddress.innerText;
                var orderId = this.$refs.orderId.innerText;
                var shopName = this.$refs.shopName.innerText;
                // console.log(newAddress);
                let fm = new FormData();
                fm.append("address", newAddress);
                fm.append("orderId", orderId);
                fm.append("shopName", shopName);
                //alert(siteUrl);
                axios
                    .post("/api/getDepositBalance", fm, config)
                    .then((response) => {
                        this.paidamount = response.data / 100000000;

                        if (this.paidamount == 0) {
                            this.confirmBalance(
                                this.paidamount,
                                orderId,
                                shopName
                            );
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            checkUserAddress() {
                var orderId = this.$refs.orderId.innerText;
                let fm = new FormData();
                fm.append("userId", userId);
                fm.append("orderId", orderId);
                axios
                    .post(this.baseUrl + "Ajaxrequest/sellconfirmBalance", fm)
                    .then((response) => {
                        if (response.data[0].address === "") {
                            this.getWalletAddress();
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            async confirmBalance(amountReceive, orderid, shopName) {
                var shopName = this.$refs.shopName.innerText;
                //let orderId = this.$refs.orderId.innerText;

                axios
                    .post(
                        baseUrl + "api/v1/fetch/orderbyid", { orderId: orderid },
                        config
                    )
                    .then((response) => {
                        var amountGet = response.data.orders[0].btcAmount;
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
                            icon: "info",
                            title: "Waiting for your Payment to be process and Check",
                        });

                        if (amountReceive >= amountGet) {
                            let fm = {
                                shopName: response.data.orders[0].shopName,
                                productId: response.data.orders[0].productId,
                                productName: response.data.orders[0].productName,
                                stock: response.data.orders[0].quantity,
                                orderId: orderid,
                            };
                            axios
                                .post("/api/UpdateBtcOrder", fm)
                                .then((response) => {
                                    Toast.fire({
                                        icon: "success",
                                        title: "Coin Cofirm Successfully",
                                    });
                                    //showNotification('top', 'center', "success", "Coin Cofirm Successfully");
                                    setTimeout(() => {
                                        window.location.href =
                                            "/Completed/" + orderid;
                                    }, 3000);
                                    //console.log(response.data);
                                })
                                .catch((error) => {
                                    console.log(error);
                                });
                        } else {
                            //this.getDepositBalance();
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
        },
    }).mount("#btcpayment");
}