<template>
  <div>
    <b-row>
      <b-colxx xxs="12">
        <piaf-breadcrumb heading="ORDERS" />
        <div class="separator mb-5"></div>
      </b-colxx>
    </b-row>
    <b-row>
      <b-colxx xxs="12">
        <b-card>
          <span class="refresh-icon" @click="reloadPage">
            <i class="simple-icon-refresh"></i>
          </span>
          <table class="table  table-striped">
            <thead>
              <tr>
                <th scope="col">Order #</th>
                <th class="text-center" scope="col">Action</th>
                <th class="text-center" scope="col">Grand Total</th>
                <th scope="col">Order Status</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Order Placed on</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(order, i) in orders" :key="i">
                <th scope="row">{{ order.id }}</th>

                <td class="d-flex justify-content-around">
                  <b-button variant="outline-primary" @click="showDetail(order.id)"
                    >Detail</b-button
                  >
                </td>

                <td class="text-center font-weight-bold">
                  Rs.{{ order.grand_total }}
                </td>

                <td>
                  <b-button
                    class="text-capitalize text-center"
                    disabled
                    pill
                    :variant="order.order_status === 'Completed' ? 'primary' : 'outline-primary'"
                    >{{ order.order_status }}</b-button
                  >
                </td>

                <td>
                  <b-button
                    class="text-capitalize"
                    disabled
                    pill
                    :variant="order.payment_status === 'Paid' ? 'danger' : 'outline-danger'"
                  >
                    {{ order.payment_status }}
                  </b-button>
                </td>
                
                <td>{{ moment(order.created_at).format('YYYY-MM-DD h:m') }}</td>
                
              </tr>
            </tbody>
          </table>
        </b-card>
      </b-colxx>
    </b-row>
    <b-modal ref="orderDetail" title="Order Details">
      <div>
        <b-table hover :fields="fields" :items="details"></b-table>
      </div>
    </b-modal>
  </div>
</template>

<script>
import { getOrders } from "@/api/orders";
import moment from 'moment'
export default {
  data() {
    return {
      orders: [],
      details: [],
      fields: [
        { key: "product.title", label: "Product" },
        { key: "price", label: "Price" },
        { key: "quantity", label: "Quantity" },
        { key: "total", label: "Total" },
      ],
    };
  },
  methods: {
    fetchAllOrders() {
      getOrders().then((res) => {
        this.orders = res.result;
      });
    },  
    reloadPage() {
      window.location.reload();
    },
    showDetail(id) {
      this.$refs["orderDetail"].show();
      this.details = this.orders.filter(
        (order) => order.id === id
      )[0].order_details;
    },
  },
  mounted() {
    this.fetchAllOrders();
    this.moment = moment
  },
};
</script>

<style>
  .refresh-icon {
  cursor: pointer;
  float: right;
}
</style>