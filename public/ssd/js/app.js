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

const loading = `<div class="spinner-grow spinner-grow-sm" role="status">
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