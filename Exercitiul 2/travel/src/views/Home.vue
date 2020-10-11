<template>
  <div class="home container">
    <h3 class="py-4">All destinations</h3>
    <div class="destinations">
      <div v-for="destination in destinations" :key="destination.name">
        <router-link :to="{ name: 'DestinationDetails', params: {id: destination.id} }" class="text-decoration-none">
          <h5 class="p-2">{{ destination.name }}</h5>
        </router-link>
        <figure>
          <router-link :to="{ name: 'DestinationDetails', params: {id: destination.id} }">
            <img
              :src="require(`@/assets/images/${destination.image}`)"
              :alt="destination.name"
            />
          </router-link>
        </figure>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import store from "@/store.js";
export default {
  name: "Home",
  components: {},
  data() {
    return {
      destinations: store.destinations
    };
  }
};
</script>
<style scoped>
.home {
  max-width: 1400px;
  margin: 0 auto;
}
img {
  max-width: 200px;
}
.destinations {
  display: flex;
  justify-content: space-between;
}
</style>
