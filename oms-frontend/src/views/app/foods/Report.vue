<template>
  <div>
    <b-row>
      <b-colxx xxs="12">
        <piaf-breadcrumb heading="REPORT" />
        <div class="separator mb-5"></div>
      </b-colxx>
    </b-row>
    <b-row>
      <b-colxx xxs="12">
        <b-card>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th class="text-right" scope="col">TITLE</th>
                <th class="text-right" scope="col">COUNT</th>
                <th class="text-center" scope="col">PRICE</th>
                <th class="text-center" scope="col">TOTAL</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </b-card>
      </b-colxx>
    </b-row>
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
    };
  },
  methods: {
    fetchAllOrders() {
      getOrders().then((res) => {
        this.orders = res.result;
      });
    },
    showDetail(id) {
      this.details = this.orders.filter(
        (order) => order.id === id
      )[0].order_details;
      console.log(this.details);
    },
  },
  mounted() {
    this.fetchAllOrders();
    this.moment = moment
    this.showDetail();
  },
};
</script>

<style>
  .month{
    width: 20px;
  }
</style>