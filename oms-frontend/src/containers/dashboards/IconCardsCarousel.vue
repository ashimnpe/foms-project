<template>
  <div class="icon-cards-row" >
    <glide-component :settings="glideIconsOption">
      <icon-card 
        title="Pending Orders" 
        icon="iconsminds-clock" 
        value="1"
        />

        <icon-card
        title="Completed Orders" 
        icon="iconsminds-coffee"
        value="3"
      />

      <icon-card
      title="Total Orders" 
        icon="iconsminds-basket-coins"
        value="4"
      />

      <icon-card
      title="Staffs" 
        icon="iconsminds-user"
        value="2"
      />
      <!-- <icon-card :title="$t('dashboards.new-comments')" icon="iconsminds-mail-read" :value="25" /> -->
    </glide-component>
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
      orders: [],
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
        console.log(res);
      });
    },
  },
  mounted(){
    this.fetchCount();
  }
};
</script>
