<template>
    <b-container class="bv-example-row">
        <b-container v-if="isLoading">
            <Spinner />
        </b-container>

        <b-container v-else>
            <div class="heading">
                <h1>Joy Foods</h1>
            </div>
            <b-form-select v-model="filters.categoryType" class="mb-3">
                <option value disabled selected>Categories</option>
                <b-form-select-option value="Burgers"
                    >Burgers</b-form-select-option
                >
                <b-form-select-option value="Beverages"
                    >Beverages</b-form-select-option
                >
                <b-form-select-option value="Combo Meal"
                    >Combo Meal</b-form-select-option
                >
            </b-form-select>
            <b-row>
                <b-col cols="6"
                    ><template>
                        <div>
                            <b-table :items="filteredOrders" :fields="fields">
                                <col
                                    v-for="(item, index) in items"
                                    :key="index"
                                />
                                <template v-slot:cell(action)="data">
                                    <b-button
                                        size="sm"
                                        @click="
                                            handleAddOrder(items[data.index])
                                        "
                                        variant="success"
                                        >Add
                                    </b-button>
                                </template>
                                <!-- additional table slots here if needed -->
                            </b-table>
                        </div>
                    </template></b-col
                >
                <b-col cols="3"
                    ><cart
                        :showOrders="orders.length === 0 ? false : true"
                        :items="orders"
                        v-on:reloadlist="getList()"
                /></b-col>
                <b-col cols="3">
                    <b-container v-show="orders.length === 0 ? false : true">
                        <b-input-group class="mb-3" size="sm" prepend="coupon">
                            <b-form-input
                                v-model="coupon"
                                :disabled="discounted"
                            ></b-form-input>
                            <b-input-group-append>
                                <b-button
                                    size="md"
                                    text="Button"
                                    variant="success"
                                    :disabled="discounted"
                                    @click="handleAddCoupon()"
                                    >Apply</b-button
                                >
                            </b-input-group-append>
                        </b-input-group>
                        <b-list-group-item v-if="discounted"
                            class="d-flex justify-content-between align-items-center"
                        >
                            <small>Coupon GO2018 applied. 10%</small>
                        </b-list-group-item>
                        <b-list-group-item
                            class="d-flex justify-content-between align-items-center"
                        >
                            <h6>Sales Tax</h6>
                            <h6>₱{{ taxValue }}</h6>
                        </b-list-group-item>
                        <b-list-group-item
                            class="d-flex justify-content-between align-items-center"
                        >
                            <h3>Total</h3>
                            <h3>₱{{ totalPrice }}</h3>
                        </b-list-group-item>
                        <br />
                        <b-container align="left">
                            <b-button block variant="success" size="lg"
                                >CHECKOUT NOW</b-button
                            >
                        </b-container>
                    </b-container>
                </b-col>
            </b-row>
        </b-container>
    </b-container>
</template>

<script>
import Cart from "./cart.vue";
import Spinner from "./spinner/spinner.vue";
export default {
    components: {
        Cart,
        Spinner,
    },
    data: function () {
        return {
            filters: {
                categoryType: "",
            },
            fields: ["name", "price", "action"],
            items: [],
            orders: [],
            totalPrice: 0,
            isLoading: false,
            coupon: "",
            discounted: false,
            taxValue: null,
            discountValue: null
        };
    },
    methods: {
        getList() {
            if (this.selected == null) {
                axios
                    .get("api/items")
                    .then((response) => {
                        this.items = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                const payloads = {
                    category: this.selected,
                };
                axios
                    .get("api/items", payloads)
                    .then((response) => {
                        this.items = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        getCart() {
            axios
                .get("api/cart")
                .then((response) => {
                    this.orders = response.data;
                })

                .catch((error) => {
                    console.log(error);
                });
            setTimeout(() => {
                this.handleTotalPrice();
            }, 1000);
        },

        handleTotalPrice() {
            if(this.orders.length == 0)
             return;
            
            this.totalPrice = this.orders.reduce(
                (acc, item) => acc + item.price,
                0
            );
            this.discountValue = this.totalPrice / 10
            this.taxValue = this.totalPrice * 0.0775
            this.totalPrice = this.totalPrice + this.taxValue
            if(this.discounted){
                
                this.totalPrice = this.totalPrice - this.discountValue
            }
            this.totalPrice = this.totalPrice.toFixed(2);
            return this.totalPrice;
        },
        handleAddOrder(data) {
            this.isLoading = true;
            axios
                .post("api/item/store", {
                    item: data,
                })
                .then((response) => {
                    if (response.status == 201) {
                        this.$emit("reloadList");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
            setTimeout(() => {
                this.getCart();
                this.isLoading = false;
                swal("Item Added!", `${data.name}`, "success");
            }, 1000);
        },
        handleAddCoupon() {
            if (this.coupon !== "GO2018") {
                return swal("Invalid coupon code", "Try again", "error");
            } else if (this.discounted) {
                return swal("Coupon already applied", "Thank you", "info");
            } else {
                this.isLoading = true;
                setTimeout(() => {
                    this.discounted = true;
                    this.handleTotalPrice()
                    
                    this.isLoading = false;
                    swal("Coupon Applied Successfully!", "Nice", "success");
                }, 1500);
            }
        },
    },
    created() {
        this.getList();
        this.getCart();
        this.handleTotalPrice() 
    },
    computed: {
        filteredOrders() {
            return this.items.filter((item) => {
                const { categoryType } = this.filters;

                const matchCategory = categoryType
                    ? categoryType === item.category
                    : true;
                return matchCategory;
            });
        },
    },
};
</script>
