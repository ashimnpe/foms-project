<template>
  <div id="root">
    <div class="fixed-background">
      <main>
        <div class="container">
          <b-row class="h-100">
            <b-colxx xxs="12" md="10" class="mx-auto my-auto">
              <b-card class="auth-card" no-body>
                <div class="position-relative image-side">
                  <p class="text-white h2">MAGIC IS IN THE FOOD</p>
                  <p class="white mb-0">Yes, it is indeed!</p>
                </div>
                <div class="form-side">
                  <router-link to="/">
                    <span ><h2><strong>Food Order Management System</strong></h2></span>
                  </router-link>
                  <br/>
                  <h6 class="mb-4">{{ $t("unauthorized.title") }}</h6>
                  <p class="mb-0 text-muted text-small mb-0">{{ $t("unauthorized.detail") }}</p>
                  <p class="display-1 font-weight-bold mb-5">503</p>
                  <b-button
                    type="submit"
                    variant="primary"
                    size="lg"
                    class="btn-shadow"
                    @click="goBack"
                  >GO BACK TO LOGIN</b-button>
                </div>
              </b-card>
            </b-colxx>
          </b-row>
        </div>
      </main>
    </div>
  </div>
</template>
<script>
import { adminRoot } from '../constants/config';
export default {
  methods: {
    goBack() {
      this.$router.push('/user/login');
    },
  },
  mounted: function () {
    document.body.classList.add("background");
  },
  beforeDestroy() {
    document.body.classList.remove("background");
  },
};
</script>
