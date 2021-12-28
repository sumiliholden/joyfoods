<template>
    <b-container>
        <div v-if="showOrders" class="cart-container">
            <b-card no-body header="Cart">
                <b-list-group v-for="(item, index) in items" :key="index">
                    <b-list-group-item
                        class="d-flex justify-content-between align-items-center"
                    >
                        {{ item.name }}
                        <h5>₱{{ item.price }}</h5>
                    </b-list-group-item>
                </b-list-group>
            </b-card>
        </div>
    </b-container>
</template>
<script>
export default {
    props: {
        showOrders: Boolean,
        items: Array,
    },
};
</script>
<style scoped>
.cart-container {
    max-height: 500px;
    margin-bottom: 10px;
    overflow: scroll;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
}
</style>
