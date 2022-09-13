<template>
  <div class="icon-cards-row" >
    <glide-component :settings="glideIconsOption">
      <!-- <icon-card 
        title="Pending Orders" 
        icon="iconsminds-clock" 
        :value="count.pending"
        />

        <icon-card
        title="Completed Orders" 
        icon="iconsminds-coffee"
        :value="count.completed"
      />

      <icon-card
      title="Total Orders" 
        icon="iconsminds-basket-coins"
        :value="count.total"
      />

      <icon-card
      title="Staffs" 
        icon="iconsminds-user"
        :value="count.user"
      /> -->
      <!-- <icon-card :title="$t('dashboards.new-comments')" icon="iconsminds-mail-read" :value="25" /> -->
    </glide-component>

    <draggable class="row icon-cards-row mb-2">
            <b-colxx xxs="6" sm="4" md="3" lg="2">
                <icon-card :title="$t('dashboards.pending-orders')" icon="iconsminds-clock" :value="count.pending" />
            </b-colxx>
            <b-colxx xxs="6" sm="4" md="3" lg="2">
                <icon-card :title="$t('dashboards.completed-orders')" icon="iconsminds-basket-coins"  :value="count.completed" />
            </b-colxx>
            <b-colxx xxs="6" sm="4" md="3" lg="2">
                <icon-card title="Canceled Orders"  icon="simple-icon-close"  :value="count.canceled" />
            </b-colxx>
            <b-colxx xxs="6" sm="4" md="3" lg="2">
                <icon-card title="Total Orders"  icon="iconsminds-coffee" :value="count.total" />
            </b-colxx>
             <b-colxx xxs="6" sm="4" md="3" lg="2">
                <icon-card title="Users"  icon="iconsminds-user"  :value="count.user" />
            </b-colxx>
        </draggable>
  </div>
</template>
<script>
import GlideComponent from "../../components/Carousel/GlideComponent";
import IconCard from "../../components/Cards/IconCard";
import { getCount } from "@/api/orders";

export default {
  components: {
    "glide-component": GlideComponent,
    "icon-card": IconCard
  },
  data() {
    return {
      count: [],
      glideIconsOption: {
        gap: 3,
        perView: 4,
        // type: "carousel",
        breakpoints: {
          320: {
            perView: 1
          },
        },
        hideNav: true
      }
    };
  },
  methods: {
    fetchCount() {
      getCount().then((res) => {
        this.count = res.result
      });
    },
  },
  mounted(){
    this.fetchCount();
  }
};
</script>
