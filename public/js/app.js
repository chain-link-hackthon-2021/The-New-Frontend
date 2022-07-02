var baseUrl;
if (document.getElementById("base_url")) {
    baseUrl = document.getElementById("base_url").value;
}
if (document.getElementById("site_url")) {
    siteUrl = document.getElementById("site_url").value;
}
// const Toast = Swal.mixin({
//     toast: true,
//     position: "top-right",
//     iconColor: "white",
//     didOpen: (toast) => {
//         toast.addEventListener("mouseenter", Swal.stopTimer);
//         toast.addEventListener("mouseleave", Swal.resumeTimer);
//     },
//     showConfirmButton: false,
//     timer: 2500,
//     timerProgressBar: true,
// });
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
                btntwoValue: "Pay With Crypto",
                btnthreeValue: "Pay With Stripe",
                // btntwoValue: '<i class="fas fa-bitcoin " style="vertical-align: middle;"></i> Pay With Crypto',
            };
        },
        mounted() {},
        methods: {
            async paycheckout(paymethod) {
                //alert(process.env);
                if (paymethod == "coinbase") {
                    this.btntwoValue = loading;
                } else if (paymethod == "stripe") {
                    this.btnthreeValue = loading;
                } else {
                    this.btnoneValue = loading;
                }

                this.btnState = true;
                let unitPrice = this.$refs.unitPrice.value;
                let shopName = this.$refs.shopName.value;
                let quantity = this.$refs.quantity.value;
                let paymentGateway = paymethod;
                let orderFrom = this.$refs.orderFrom.value;
                let totalPrice = this.$refs.price.value;
                let productName = this.$refs.productName.value;
                let productId = this.$refs.productId.value;
                let discount = this.$refs.Camount.innerText;
                Camount;
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
                        discount: discount,
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
                            } else if (paymethod == "stripe") {
                                setTimeout(() => {
                                    window.location.href =
                                        "/@" +
                                        shopName +
                                        "/StripePayment/" +
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
                        window.location.href = "";
                    }
                } catch (err) {
                    console.log(err);
                }
            },
        },
    }).mount("#loadpayment");
}
if (document.getElementById("payment")) {
    var merchantId = document.getElementById("merchantID").value;
    var partner_client_id = document.getElementById("partner_client_id").value;
    const app = Vue.createApp({
        data() {
            return {
                price: 0,
                btnState: false,
                btnoneValue: "Pay With Crypto",
                btntwoValue: "Pay With PayPal",
                btntwoValue: "Pay With Stripe",
            };
        },
        async mounted() {
            let pId = this.$refs.uniqueID.value;
            const script = document.createElement("script");
            script.src =
                "https://www.paypal.com/sdk/js?&client-id=" +
                partner_client_id +
                "&merchant-id=" +
                merchantId +
                "&currency=USD";
            script.addEventListener("load", this.setLoaded);
            document.body.appendChild(script);
        },
        methods: {
            setLoaded() {
                let price = this.$refs.amount.value;
                let orderid = this.$refs.orderid.value;
                let shopName = this.$refs.shopName.value;
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
                                    let ress = await axios.post(
                                        baseUrl +
                                        "api/v1/fetch/single/shop/name", { shopName: shopName },
                                        config
                                    );
                                    let res = await axios.post(
                                        baseUrl + "api/v1/fetch/single/product", { uniqueID: pId },
                                        config
                                    );
                                    // console.log(res.data.product[0].stock);

                                    var stock = res.data.product[0].stock;
                                    var nuestock = [];
                                    var strstock = ([] = stock.split(","));
                                    for (
                                        let index = 0; index < parseInt(quantity); index++
                                    ) {
                                        nuestock[index] = strstock[index];
                                    }
                                    let credit =
                                        parseInt(
                                            ress.data.shops[0].shopCredit
                                        ) - parseInt(1);
                                    // console.log(ress);

                                    axios
                                        .post(
                                            baseUrl +
                                            "api/v1/update/order/status", {
                                                orderId: orderid,
                                                orderStatus: "completed",
                                                orderItem: nuestock.join(","),
                                            },
                                            config
                                        )
                                        .then((response) => {
                                            axios
                                                .post(
                                                    baseUrl +
                                                    "api/v1/add/credits", {
                                                        shopName: ress.data.shops[0]
                                                            .name,
                                                        shopCredit: credit,
                                                    },
                                                    config
                                                )
                                                .then((response) => {});
                                            axios
                                                .post(
                                                    baseUrl +
                                                    "api/v1/update/product/stock", {
                                                        productId: pId,
                                                        stock: strstock
                                                            .splice(
                                                                parseInt(
                                                                    quantity
                                                                )
                                                            )
                                                            .join(","),
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
                //   var newAddress = this.$refs.newAddress.innerText;
                var orderId = this.$refs.orderId.innerText;
                var shopName = this.$refs.shopName.innerText;
                // console.log(newAddress);
                let fm = new FormData();
                // fm.append("address", newAddress);
                fm.append("orderId", orderId);
                fm.append("shopName", shopName);
                //alert(siteUrl);
                axios
                    .post("/api/getDepositBalance", fm, config)
                    .then((response) => {
                        console.log(response.data);
                        setTimeout(() => {
                            // window.location.href = "";
                        }, 2000);
                        // this.paidamount = response.data / 100000000;

                        // if (this.paidamount == 0) {
                        //     this.confirmBalance(
                        //         this.paidamount,
                        //         orderId,
                        //         shopName
                        //     );
                        // }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            // checkUserAddress() {
            //     var orderId = this.$refs.orderId.innerText;
            //     let fm = new FormData();
            //     fm.append("userId", userId);
            //     fm.append("orderId", orderId);
            //     axios
            //         .post(this.baseUrl + "Ajaxrequest/sellconfirmBalance", fm)
            //         .then((response) => {
            //             if (response.data[0].address === "") {
            //                 this.getWalletAddress();
            //             }
            //         })
            //         .catch((error) => {
            //             console.log(error);
            //         });
            // },
            // async confirmBalance(amountReceive, orderid, shopName) {
            //     var shopName = this.$refs.shopName.innerText;
            //     //let orderId = this.$refs.orderId.innerText;

            //     axios
            //         .post(
            //             baseUrl + "api/v1/fetch/orderbyid", { orderId: orderid },
            //             config
            //         )
            //         .then((response) => {
            //             var amountGet = response.data.orders[0].btcAmount;
            //             const Toast = Swal.mixin({
            //                 toast: true,
            //                 position: "top-end",
            //                 showConfirmButton: false,
            //                 timer: 4000,
            //                 timerProgressBar: true,
            //                 didOpen: (toast) => {
            //                     toast.addEventListener(
            //                         "mouseenter",
            //                         Swal.stopTimer
            //                     );
            //                     toast.addEventListener(
            //                         "mouseleave",
            //                         Swal.resumeTimer
            //                     );
            //                 },
            //             });
            //             Toast.fire({
            //                 icon: "info",
            //                 title: "Waiting for your Payment to be process and Check",
            //             });

            //             if (amountReceive >= amountGet) {
            //                 let fm = {
            //                     shopName: response.data.orders[0].shopName,
            //                     productId: response.data.orders[0].productId,
            //                     productName: response.data.orders[0].productName,
            //                     stock: response.data.orders[0].quantity,
            //                     orderId: orderid,
            //                 };
            //                 axios
            //                     .post("/api/UpdateBtcOrder", fm)
            //                     .then((response) => {
            //                         Toast.fire({
            //                             icon: "success",
            //                             title: "Coin Cofirm Successfully",
            //                         });
            //                         //showNotification('top', 'center', "success", "Coin Cofirm Successfully");
            //                         setTimeout(() => {
            //                             window.location.href =
            //                                 "/Completed/" + orderid;
            //                         }, 3000);
            //                         //console.log(response.data);
            //                     })
            //                     .catch((error) => {
            //                         console.log(error);
            //                     });
            //             } else {
            //                 //this.getDepositBalance();
            //             }
            //         })
            //         .catch((error) => {
            //             console.log(error);
            //         });
            // },
        },
    }).mount("#btcpayment");
}
if (document.getElementById("paycredit")) {
    const app = Vue.createApp({
        data() {
            return {
                selectedcredit: "",
                creditpay: "",
                // btnState: false,
                // btnoneValue: "Pay With PayPal",
            };
        },
        mounted() {
            const script = document.createElement("script");
            script.src =
                "https://www.paypal.com/sdk/js?client-id=AZ4nF2Gcr-Afy1P2zqp8MeUIQ7kSS-e9kvADv5ynLTtw4HC_jMucHIvHesgXLRx8ooWebaJffVKp0yNW";
            script.addEventListener("load", this.setLoaded);
            document.body.appendChild(script);
            // this.loadstripe();
        },
        methods: {
            setLoaded() {
                // let orderid = this.$refs.orderid.value;

                window.paypal
                    .Buttons({
                        createOrder: function(data, actions) {
                            //         //actions.disable();
                            var ddl = document.getElementById("check");
                            var selectedValue =
                                ddl.options[ddl.selectedIndex].value;
                            this.selectedcredit = selectedValue;
                            const myArray = selectedValue.split(",");

                            if (selectedValue == "") {
                                alert("Please select a Credit type");
                            } else {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            currency_code: "USD",
                                            value: myArray[0],
                                        },
                                    }, ],
                                });
                            }
                        },
                        onApprove: async(data, actions) => {
                            const order = await actions.order.capture();

                            if (order.status == "COMPLETED") {
                                let shopname = this.$refs.shopname.outerText;
                                let credit = this.selectedcredit;
                                let ordercerdit = myArray[1];

                                await axios
                                    .post(
                                        "/api/UpdateCredit", {
                                            shopName: shopname,
                                            credit: credit,
                                            ordercerdit: ordercerdit,
                                        },
                                        config
                                    )
                                    .then((response) => {
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
                                            title: "Credit TopUp Successfully",
                                        });
                                        if (response.data.status == "success") {
                                            setTimeout(() => {
                                                window.location.href = "";
                                            }, 3000);
                                        } else {
                                            window.location.href = "";
                                        }
                                    });
                            }
                        },
                        onError: (err) => {
                            console.log(err);
                        },
                    })
                    .render(this.$refs.paypal);
            },
            async loadstripe() {
                var ddl = document.getElementById("check");
                var selectedValue = ddl.options[ddl.selectedIndex].value;
                this.selectedcredit = selectedValue;
                const myArray = selectedValue.split(",");
                //  myArray[0]
                let shopname = this.$refs.shopname.outerText;
                // let credit = this.selectedcredit;
                let ordercerdit = myArray[1];
                if (selectedValue == "") {
                    alert("Please select a Credit type");
                } else {
                    await axios
                        .post(
                            baseUrl + "create-credit-session", {
                                shopName: shopname,
                                shopCredit: ordercerdit,
                                amount: myArray[0],
                            },
                            config
                        )
                        .then((response) => {
                            window.location.href = response.data.url;
                        });
                }
            },
            async loadcoinbase() {
                var ddl = document.getElementById("check");
                var selectedValue = ddl.options[ddl.selectedIndex].value;
                this.selectedcredit = selectedValue;
                const myArray = selectedValue.split(",");
                //  myArray[0]
                let shopname = this.$refs.shopname.outerText;
                // let credit = this.selectedcredit;
                let ordercerdit = myArray[1];
                if (selectedValue == "") {
                    alert("Please select a Credit type");
                } else {
                    await axios
                        .post(
                            baseUrl + "api/v1/payment/coinbase", {
                                shopName: shopname,
                                shopCredit: ordercerdit,
                                totalAmount: myArray[0],
                            },
                            config
                        )
                        .then((response) => {
                            window.location.href = response.data.url;
                        });
                }
            },
        },
    }).mount("#paycredit");
}

if (document.getElementById("dropFeedback")) {
    const app = Vue.createApp({
        data() {
            return {
                btnState: false,
                feedmessage: "",
            };
        },
        methods: {
            async leavefeed() {
                console.log(this.$refs.rate);
                this.btnState = true;
                let data = JSON.stringify({
                    shopName: this.$refs.shopName.value,
                    orderID: this.$refs.orderId.value,
                    customerMessage: this.feedmessage,
                    Type: this.$refs.rate.innerText,
                });
                if (this.message == "" || this.$refs.rate.value == "") {
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
                        title: "Empty Field!!",
                    });
                } else {
                    let res = await axios.post(
                        baseUrl + "api/v1/add/feedback",
                        data,
                        config
                    );
                    try {
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
                                title: "FeedBack Send Successfully!!",
                            });
                            setTimeout(() => {
                                window.location.href =
                                    "/@" + this.$refs.shopName.value;
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
                                icon: "info",
                                title: "FeedBack Send Already!!",
                            });
                            setTimeout(() => {
                                window.location.href =
                                    "/@" + this.$refs.shopName.value;
                            }, 3000);
                        }
                    } catch (error) {
                        this.btnState = false;
                    }
                }
            },
        },
    }).mount("#dropFeedback");
}
if (document.getElementById("withdrawcrypto")) {
    const app = Vue.createApp({
        data() {
            return {
                btnState: false,
                amount: "",
            };
        },
        methods: {
            async withdrawcrypto() {
                this.btnState = true;
                let data = JSON.stringify({
                    walletadd: this.$refs.walletadd.value,
                    amount: this.amount,
                    shopName: this.$refs.shopName.value,
                });
                if (this.amount == "" || this.$refs.walletadd.value == "") {
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
                        title: "Empty Field!!",
                    });
                } else {
                    const res = await axios.post(
                        "/api/cryptoCharge",
                        data,
                        config
                    );
                    try {
                        console.log(res.data.status);
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
                                title: "Coin Withdraw Successfully!!",
                            });
                            setTimeout(() => {
                                window.location.href = "";
                            }, 3000);
                        } else if (res.data == 2) {
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
                                title: "Low Coin To Withdraw!!",
                            });

                            this.btnState = false;
                            setTimeout(() => {
                                window.location.href = "";
                            }, 3000);
                        }
                    } catch (error) {
                        this.btnState = false;
                    }
                }
            },
        },
    }).mount("#withdrawcrypto");
}