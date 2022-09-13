<template>
  <div>
    <b-row>
      <b-colxx xxs="12">
        <piaf-breadcrumb heading="SALES REPORT" />
        <div class="separator mb-3"></div>
      </b-colxx>
    </b-row>
    <b-row>
      <b-colxx xxs="12">
        <b-card>
          <div>
            <b-row class="mb-3">
              <b-colxx class="offset-7 col-md-2">
                <b-form-select
                  v-model="selectedDateType"
                  :options="dateType"
                  @change="fetchReport"
                  size="sm"
                >
                </b-form-select>
              </b-colxx>

              <b-colxx class="col-md-3">
                <b-form-select
                  :disabled="selectedDateType != 'Month'"
                  v-model="selectedMonth"
                  :options="months"
                  @change="fetchReport"
                  size="sm"
                >
                </b-form-select>
              </b-colxx>
            </b-row>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">TITLE</th>
                <th scope="col">COUNT</th>
                <th scope="col">PRICE</th>
                <th scope="col">DATE</th>
                <th scope="col">NET TOTAL</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(detail, i) in details" :key="i">
                <td>{{ ++i }}</td>
                <td>{{ detail.product.title }}</td>
                <td>{{ detail.total_qty }}</td>
                <td>Rs. {{ detail.price }}</td>
                <td>{{ moment(detail.created_at).format("YYYY-MM-DD") }}</td>
                <td>Rs. {{ detail.total_amount }}</td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="font-weight-bold">
                <td colspan="5" class="text-center" variant="primary">
                  GRAND TOTAL
                </td>
                <td>Rs.{{ grandTotal }}</td>
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
      dateType: [
        "Today",
        "Yesterday",
        "Month",
      ],
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
      selectedDateType: "Today",
      selectedMonth: "",
      grandTotal: 0
    };
  },
  methods: {
    fetchReport() {
      this.details = [];
      if (this.selectedDateType === 'Month' && this.selectedMonth === "") return

        getReport({
          date_type: this.selectedDateType,
          month: this.selectedMonth,
        }).then((res) => {
           
          let grandTotal = 0
          const temp = res.result.filter(y => {
            return (y.order && y.order.deleted_at === null)
          })
          temp.map((x) => {
            grandTotal += x.total_amount
          })
          this.grandTotal = grandTotal
          this.details = temp
        });
    },
  },
  mounted() {
    this.fetchReport();
    this.moment = moment;
  },
};
</script>

<style>
.month {
  width: 20px;
}

button {
  float: right;
}
</style>