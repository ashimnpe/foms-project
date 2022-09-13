<template>
  <div>
    <b-row>
      <b-colxx xxs="12">
        <piaf-breadcrumb heading="MONTHLY REPORT" />
        <div class="separator mb-5"></div>
      </b-colxx>
    </b-row>
    <b-row>
      <b-colxx xxs="12">
        <b-card>
          <div>
            <form action="" @click="fetchReport(selectedMonth)">
              <b-row>
                <b-col class="col-md-5">
                    <b-form-select
                      v-model="selected"
                      :options="months"
                      size="sm"
                    >
                      </b-form-select>
                </b-col>
                <b-col class="col-md-3">
                  <button class="btn btn-danger">generate report</button>
                </b-col>
              </b-row>
            </form>
          </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">TITLE</th>
                <th scope="col">COUNT</th>
                <th scope="col">PRICE</th>
                <th scope="col">NET TOTAL</th>
                <th scope="col">DATE</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(detail, i) in details" :key="i">
                <td>{{ detail.id }}</td>
                <td>{{ detail.product.title }}</td>
                <td>{{ detail.total_qty }}</td>
                <td>Rs. {{ detail.price }}</td>
                <td>Rs. {{ detail.total_amount }}</td>
                <td>{{ moment(detail.created_at).format("YYYY-MM") }}</td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="font-weight-bold">
                <td colspan="5" class="text-center">GRAND TOTAL</td>
                <td>Rs.{{ details.grand_total }}</td>
              </tr>
            </tfoot>
          </table>
        </b-card>
      </b-colxx>
    </b-row>
  </div>
</template>

<script>
import { getReport } from "@/api/report";
import moment from "moment";
export default {
  data() {
    return {
      details: [],
      selected: null,
      dateType: ["Month"],
      months: [
        { value: null, text: "Please select an option" },
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
      // selectedDateType: "Today",
      selectedMonth: "",
    };
  },
  methods: {
    fetchReport() {
      getReport({
        // date_type: this.selectedDateType,
        month: this.selectedMonth,
      }).then((res) => {
        console.log(this.month);
        const details = res.result;
        this.details = details;
      });
    },
  },
  mounted() {
    this.moment = moment;
    this.fetchReport();
  },
};
</script>

<style>
</style>